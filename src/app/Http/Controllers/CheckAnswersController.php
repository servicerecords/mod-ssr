<?php

namespace App\Http\Controllers;

use App\Models\Application;;

class CheckAnswersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        dd(session()->all());

        return view('check-answers', [
            'serviceperson' => Application::getInstance()->getServiceperson(),
            'applicant' => Application::getInstance()->getApplicant(),
        ]);
    }

    /**
     * Customer has confirmed their answers.
     */
    public function save() {

    }
}
