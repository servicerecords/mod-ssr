<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantDetailsRequest;
use App\Http\Requests\ApplicantRelationshipRequest;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Constant;
use Illuminate\Http\Request;

class ApplicantRelationshipController extends Controller
{
    /**
     * @var string[]
     */
    public $relationships = [
        [
            'label' => Constant::RELATION_UNRELATED,
            'value' => Constant::RELATION_UNRELATED,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_SPOUSE,
            'value' => Constant::RELATION_SPOUSE,
            'children' => [
                [
                    'label' => 'Confirm here if you were the spouse or civil partner at the time of the serviceperson\'s death.
                                This action exempts you from paying the fee.',
                    'field' => 'spouse-at-death',
                    'value' => Constant::YES,
                    'type' => 'x-checkbox'
                ]
            ]
        ],
        [
            'label' => Constant::RELATION_CHILD,
            'value' => Constant::RELATION_CHILD,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_GRANDCHILD,
            'value' => Constant::RELATION_GRANDCHILD,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_PARENT,
            'value' => Constant::RELATION_PARENT,
            'children' => [
                [
                    'label' => 'Confirm here that there was no spouse or civil partner at the time of the serviceperson\'s death.
                                This action exempts you from paying the fee.',
                    'field' => 'no-surviving-spouse',
                    'value' => Constant::YES,
                    'type' => 'x-checkbox'
                ]
            ]
        ],
        [
            'label' => Constant::RELATION_SIBLING,
            'value' => Constant::RELATION_SIBLING,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_NIECE_NEPHEW,
            'value' => Constant::RELATION_NIECE_NEPHEW,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_GRANDPARENT,
            'value' => Constant::RELATION_GRANDPARENT,
            'children' => []
        ],
        [
            'label' => Constant::RELATION_OTHER,
            'value' => Constant::RELATION_OTHER,
            'children' => [
                [
                    'label' => 'Please specify',
                    'field' => 'other',
                    'type' => 'x-textfield'
                ]
            ]
        ],
    ];

    /**
     * Fields which pertain to the form this controller is responsible for
     * @var string[]
     */
    protected $fields = [
        'applicant-relationship',
        'applicant-relationship-spouse-at-death',
        'applicant-relationship-no-surviving-spouse',
        'applicant-relationship-other',
    ];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('applicant-relationship', [
            'relationships' => $this->relationships
        ]);
    }

    /**
     * @param ApplicantRelationshipRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(ApplicantRelationshipRequest $request)
    {
        foreach ($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        Application::getInstance()->markSectionComplete(Constant::SECTION_APPLICANT_RELATIONSHIP);

        if(Application::getInstance()->sectionComplete(Constant::SECTION_CHECK_ANSWERS)) {
            return redirect()->route('check-answers');
        }

        if ($request->input('application-relationship') === Constant::RELATION_UNRELATED) {
            return redirect()->route('check-answers');
        }

        return redirect()->route('applicant-next-of-kin');
    }
}
