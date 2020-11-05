<?php

namespace App\Http\Controllers;

use App\Http\Requests\EssentialInformationRequest;

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
        'serviceperson-date-of-birth-day',
        'serviceperson-date-of-birth-month',
        'serviceperson-date-of-birth-year'
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
        foreach($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        return redirect()->route('serviceperson-details');
    }
}
