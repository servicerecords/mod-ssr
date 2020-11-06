<?php

namespace App\Http\Controllers;

use App\Models\Application;

;

class CheckAnswersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $application = Application::getInstance();

        return view('check-answers', [
            'serviceperson' => $application->getServiceperson(),
            'applicant' => $application->getApplicant(),
        ]);
    }

    /**
     * Customer has confirmed their answers.
     */
    public function save()
    {

    }
}
