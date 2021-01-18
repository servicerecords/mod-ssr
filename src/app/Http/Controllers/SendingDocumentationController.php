<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendingDocumentationRequest;
use App\Models\Application;
use App\Models\Constant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;
use ImagickPixel;
use Ramsey\Uuid\Uuid;

class SendingDocumentationController extends Controller
{
    const MAX_FILESIZE = 2000000;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function index()
    {
        return view('sending-documentation');
    }

    /**
     * @param SendingDocumentationRequest $request
     * @return RedirectResponse
     * @throws ImagickException
     */
    public function save(SendingDocumentationRequest $request)
    {
        if (session('death-certificate')) {
            Storage::delete(session('death-certificate'));
            session()->forget('death-certificate');
        }

        $filename = Uuid::uuid4();
        $path = $request->file('death-certificate')->storeAs(
            'uploaded',
            $filename . '.' . $request->file('death-certificate')->extension(),
            []
        );

        Storage::makeDirectory('converted');
        $document = storage_path('app/' . $path);

        if ($request->file('death-certificate')->extension() === 'pdf') {
            $image = new Imagick($document . '[0]');
        } else {
            $imageData = file_get_contents($document);
            $gdImage = imagecreatefromstring($imageData);

            if (filesize($document) > self::MAX_FILESIZE) {
                if (imagesx($gdImage) > imagesy($gdImage)) {
                    $gdImage = imagescale($gdImage, 824, 595);
                } else {
                    $gdImage = imagescale($gdImage, 595, 824);
                }
            }

            ob_start();
            imagejpeg($gdImage);
            $image = new Imagick();
            $image->readImageBlob(ob_get_contents());
            ob_end_clean();
        }

        $imageQuality = 100;
        $image->setImageFormat('jpg');
        $image->setColorspace(Imagick::COLORSPACE_GRAY);
        $image->transformImageColorspace(Imagick::COLORSPACE_GRAY);

        if ($image->getImageLength() > self::MAX_FILESIZE) {
            if ($image->getImageWidth() > $image->getImageHeight()) {
                $image->scaleImage(824, 595, Imagick::FILTER_LANCZOS);
            } else {
                $image->scaleImage(595, 824, Imagick::FILTER_LANCZOS);
            }
        }

        try {
            if ($image->getImageWidth() > $image->getImageHeight())
                $image->rotateImage(new ImagickPixel('#00000000'), 90);
        } catch (ImagickException $exception) {
        }

        do {
            $image->setCompressionQuality($imageQuality--);
        } while ($image->getImageLength() > self::MAX_FILESIZE && $imageQuality > 10);

        $image->setImageFormat('pdf');
        $image->writeImage(storage_path('app/converted/' . $filename . '.pdf'));

        Storage::delete($document);
        session(['death-certificate' => 'app/converted/' . $filename . '.pdf']);

        Application::getInstance()->markSectionComplete(Constant::SECTION_DEATH_CERTIFICATE);

        if(Application::getInstance()->sectionComplete(Constant::SECTION_CHECK_ANSWERS)) {
            return redirect()->route('check-answers');
        }

        return redirect()->route('applicant-details');
    }
}
