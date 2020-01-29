<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackSave;
use Alphagov\Notifications\Exception\NotifyException;
use GuzzleHttp\Client as GuzzleClient;
use Alphagov\Notifications\Client as Notify;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{

    public function index()
    {
        return view('feedback.index');
    }

    public function save(FeedbackSave $request)
    {
        $validated = $request->validated();

        $notifyClient = new \Alphagov\Notifications\Client([
            'apiKey' => env('NOTIFY_API_KEY'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);

        try {
            $response = $notifyClient->sendEmail(
                env('FEEDBACK_EMAIL'),
                '0f3b68c3-4589-4466-a743-73f73e841187',
                [
                    'service' => $request->input('service'),
                    'feedback' => (null === $request->input('more_detail') ? $request->input('more_detail') : '-')
                ]);
            return $response;
        } catch(\Exception $e) {
            return $e;
        }

        return redirect('/feedback/success');
    }
}
