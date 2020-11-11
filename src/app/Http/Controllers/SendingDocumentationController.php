<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendingDocumentationRequest;
use App\Models\Application;
use App\Models\Constant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Ramsey\Uuid\Uuid;

class SendingDocumentationController extends Controller
{
    const MAX_FILESIZE = 2000000;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function index()
    {
        if (session('serviceperson-died-in-service', Constant::YES) === Constant::YES) {
            return redirect()->route('sending-documentation');
        }

        return view('sending-documentation');
    }

    /**
     * @param SendingDocumentationRequest $request
     * @return RedirectResponse
     * @throws \ImagickException
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
        $image = new Imagick($document);
        if ($request->file('death-certificate')->extension() === 'pdf') {
            $image = new Imagick($document . '[0]');
        }

        $imageQuality = 100;
        $image->setImageFormat('jpg');
        $image->setColorspace(Imagick::IMGTYPE_GRAYSCALE);

        if ($image->getImageWidth() > $image->getImageHeight()) {;
            $image->rotateImage(Imagick::COLOR_BLACK, 90);
        }

        if ($image->getImageLength() > self::MAX_FILESIZE) {
            $image->scaleImage(595, 824, Imagick::FILTER_LANCZOS);
        }

        do {
            $image->setCompressionQuality($imageQuality--);
        } while ($image->getImageLength() > self::MAX_FILESIZE && $imageQuality > 10);

        $image->setImageFormat('pdf');
        $image->writeImage(storage_path('app/converted/' . $filename . '.pdf'));

        Storage::delete($path);
        session(['death-certificate' => 'app/converted/' . $filename . '.pdf']);

        Application::getInstance()->markSectionComplete(Constant::SECTION_DEATH_CERTIFICATE);
        return redirect()->route('applicant-details');
    }
}
