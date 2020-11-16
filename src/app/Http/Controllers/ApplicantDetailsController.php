<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantDetailsRequest;
use App\Models\Application;
use App\Models\Constant;
use Illuminate\Http\Request;

class ApplicantDetailsController extends Controller
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
        'applicant-name',
        'applicant-email-address',
        'applicant-address-line-1',
        'applicant-address-line-2',
        'applicant-address-town',
        'applicant-address-postcode',
        'applicant-address-country',
        'applicant-telephone',
        'applicant-details-transfer',
    ];

    public function index()
    {
        return view('applicant-details', [
            'options' => $this->options
        ]);
    }

    public function save(ApplicantDetailsRequest $request)
    {
        foreach ($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        Application::getInstance()->markSectionComplete(Constant::SECTION_APPLICANT_DETAILS);

        if(Application::getInstance()->sectionComplete(Constant::SECTION_CHECK_ANSWERS)) {
            return redirect()->route('check-answers');
        }
        return redirect()->route('applicant-relationship');
    }
}
