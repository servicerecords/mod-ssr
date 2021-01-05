<?php

namespace App\Http\Controllers;

use App\Http\Requests\EssentialInformationRequest;
use App\Models\Application;
use App\Models\Constant;

class EssentialInformationController extends Controller
{
    /**
     * Fields which pertain to the form this controller is responsible for
     * @var string[]
     */
    protected $fields = [
        'serviceperson-first-name',
        'serviceperson-last-name',
        'serviceperson-place-of-birth',
        'serviceperson-date-of-birth-date-day',
        'serviceperson-date-of-birth-date-month',
        'serviceperson-date-of-birth-date-year'
    ];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('essential-information');
    }

    /**
     * @param EssentialInformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(EssentialInformationRequest $request)
    {
        foreach ($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        Application::getInstance()->markSectionComplete(Constant::SECTION_ESSENTIAL_INFO);

        if(Application::getInstance()->sectionComplete(Constant::SECTION_CHECK_ANSWERS)) {
            return redirect()->route('check-answers');
        }

        return redirect()->route('serviceperson-details');
    }
}
