<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantNextOfKinRequest;
use App\Models\Application;
use App\Models\Constant;

class ApplicantNextOfKinController extends Controller
{
    /**
     * @var string[]
     */
    public $options = [
        [
            'label' => Constant::YES,
            'value' => Constant::YES,
            'children' => []
        ],
        [
            'label' => Constant::NO,
            'value' => Constant::NO,
            'children' => []
        ],
    ];

    /**
     * Fields which pertain to the form this controller is responsible for
     * @var string[]
     */
    protected $fields = [
        'applicant-next-of-kin',
    ];

    public function index()
    {
        return view('applicant-next-of-kin', [
            'options' => $this->options
        ]);
    }

    public function save(ApplicantNextOfKinRequest $request)
    {
        foreach ($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        Application::getInstance()->markSectionComplete(Constant::SECTION_APPLICANT_NEXT_OF_KIN);

        return redirect()->route('check-answers');
    }
}
