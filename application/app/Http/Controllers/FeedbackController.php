<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackSave;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    /**
     * Show the feedback form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('feedback.index');
    }

    /**
     * Show the feedback success view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {
        return view('feedback.success');
    }


    /**
     * If the POST data validates send it to notify this works in very much the same was as the notification elsewhere
     * in the code, we sent our api key and template ID to notify along with an array of Data we want to replace in our
     * template.
     *
     * @param FeedbackSave $request
     * @return \Exception|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(FeedbackSave $request)
    {
        //git commit -dd($request->all());
        $validated = $request->validated();

        $notifyClient = new \Alphagov\Notifications\Client([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);

        try {
            $params = [
                'service' => $request->input('service'),
                'feedback' => (null !== $request->input('more_detail') ? $request->input('more_detail') : '-')
            ];
            $response = $notifyClient->sendEmail(
                env('FEEDBACK_EMAIL', 'liam.cusack582@mod.gov.uk'),
                '0f3b68c3-4589-4466-a743-73f73e841187',
                $params);
            return redirect('/feedback/success');
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email(Request $request) {
        return view('email.confirmation', [
            'service_url' => env('APP_URL', 'http://localhost:8000/')
        ]);
    }
}
