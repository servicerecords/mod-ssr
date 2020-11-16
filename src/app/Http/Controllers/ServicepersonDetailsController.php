<?php

namespace App\Http\Controllers;


use App\Http\Requests\ServicepersonDetailsRequest;
use App\Models\Application;
use App\Models\Constant;
use App\Models\ServiceBranch;

class ServicepersonDetailsController extends Controller
{
    /**
     * Fields which pertain to the form this controller is responsible for
     * @var string[]
     */
    protected $fields = [];

    /**
     * ServicepersonDetailsController constructor.
     */
    public function __construct()
    {
        if (!session('service')) {
            return redirect()->route('service');
        }
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('serviceperson-details');
    }

    /**
     * @param ServicepersonDetailsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(ServicepersonDetailsRequest $request)
    {
        $this->clearInput();

        $service = session('service');
        $diedInService = session('serviceperson-died-in-service', Constant::YES) === Constant::YES;

        $this->fields = ServiceBranch::getInstance()->getFields($service, $diedInService);

        foreach ($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        Application::getInstance()->markSectionComplete(Constant::SECTION_SERVICEPERSON_DETAILS);

        if(Application::getInstance()->sectionComplete(Constant::SECTION_CHECK_ANSWERS)) {
            return redirect()->route('check-answers');
        }

        if (Application::getInstance()->deathCertificateRequired() === Constant::YES) {
            return redirect()->route('sending-documentation');
        }

        return redirect()->route('applicant-details');
    }

    /**
     * Clear all fields for the Service Person to keep future queries clean
     *
     * @return void
     */
    private function clearInput()
    {
        foreach (ServiceBranch::getInstance()->getFields() as $field) {
            session()->forget($field);
        }
    }
}
