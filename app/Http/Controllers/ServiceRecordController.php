<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunicationRequest;
use App\Http\Requests\VerifyRequestSave;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\DeathInServiceSave;
use App\Http\Requests\EssentialInformationSave;
use App\Http\Requests\RecordRequestSave;
use App\Http\Requests\ServiceChoiceSave;
use App\Http\Requests\ServiceDetailsSave;
use App\Http\Requests\YourInformationSave;
use App\Http\Requests\RelationRequest;
use App\Http\Requests\RelationshipRequest;
use Illuminate\Support\Facades\Storage;

class ServiceRecordController extends Controller
{
    /**
     * Show the users our welsome page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
	{
		return view('welcome');
	}

    /**
     * Show the user the first question page of our application.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function recordRequest(Request $request)
	{
		//$referrer = $request->server('HTTP_REFERER');
		return view('request');
	}

    /**
     * @param RecordRequestSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function recordRequestSave(RecordRequestSave $request)
	{
		//We can just redirect for now as we don't need to save anything
		return redirect('/service');
	}

    /**
     * Allow the user to make a service
     * $service can be null, it's only set if the user has made a choice and is coming back to this page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function serviceChoice(Request $request)
	{
		$service = $request->session()->get('service');
		//$referer = $request->server('HTTP_REFERER');
		return view('service', ['service' => $service]);
	}

    /**
     * Save the service choice the user has made, we validate the POST data here to make sure a valid service has
     * been selected. If valid we create a reference if one is not already in existence, we save that reference and
     * the selected service in the session.
     *
     * @param ServiceChoiceSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function serviceChoiceSave(ServiceChoiceSave $request)
	{
		$validated = $request->validated();
		if(null === $request->session()->get('reference')) {
			$request->session()->put('reference', $this->_createReference($request->input('service')));
		}

		$request->session()->put('service', $request->input('service'));
		//dd($request->session()->get('service'));
		return redirect('/service/death-in-service');
	}

    /**
     * Serve the death in service page, $death_in_service will be null if the user has not previously made a choice,
     * the aforementioned var is used to set the value of the radio if the user is coming back to the page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function deathInService(Request $request)
	{
		$death_in_service = $request->session()->get('death_in_service');
		//$referer = $request->server('HTTP_REFERER');
		return view('deathInService', ['death_in_service' => $death_in_service]);
	}

    /**
     * Validate the choice, the user must make a choice an empty POST is not valid.
     * If the post is valid save the valie to the session and move the user on in the process.
     *
     * @param DeathInServiceSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function deathInServiceSave(DeathInServiceSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('death_in_service', $request->all());
		return redirect('/essential-information');
	}

    /**
     * Serve the user the essential information page.
     * $essential_information will be null unless a POST has previously been saved. If it is not null it will be used to
     * repopulate the form fields where applicable.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function essentialInformation(Request $request)
	{
		$essential_information = $request->session()->get('essential_information');
		//$referer = $request->server('HTTP_REFERER');
		return view('essentialInformation', ['essential_information' => $essential_information]);
	}

    /**
     * Save the data (if valid) to the session, if its not valid return the user to the form and show the validation
     * messages.
     * We need create a data here from 3 seperate input so pass those inputs to the _createDateString method.
     *
     * @param EssentialInformationSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function essentialInformationSave(EssentialInformationSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('essential_information', $request->all());
		$request->session()->put('essential_information.dob', $this->_createDateString($request->session()->get('essential_information.dob_day'), $request->session()->get('essential_information.dob_month'), $request->session()->get('essential_information.dob_year')));
		return redirect('/service-details');
	}

    /**
     * Allow the user fill in the service details, we build the template based on the service they chose earlier in the
     * process, you may see an error of template undefined when in debug mode, this means that no service was chosen
     * (this shouldn't be possible) or the session has been flushed. It's normally seen when the service has been idle.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function serviceDetails(Request $request)
	{
		switch($request->session()->get('service'))
		{
			case "Royal Navy / Royal Marines":
				$template = "their-details-navy";
			break;
			case "Army":
				$template = "their-details-army";
			break;
			case "Royal Air Force (RAF)":
				$template = "their-details-raf";
			break;
			case "Home Guard":
				$template = "their-details-home-guard";
			break;
		}
		if($request->session()->get('death_in_service.death') == 'Yes' && $request->session()->get('service') != 'Unknown')
		{
			$service_details = $request->session()->get('service_details');

			return view($template.'-dis', ['service_details' => $service_details]);
		}
		elseif($request->session()->get('death_in_service.death') == 'No')
		{
			$service_details = $request->session()->get('service_details');
			return view($template, ['service_details' => $service_details]);
		}
		else
		{
			$service_details = $request->session()->get('service_details');
			return view($template, ['service_details' => $service_details]);
		}
	}

    /**
     * Save the service details again we need to parse some dates here so will use the _createDateString function, if the
     * death in service is unknown we send the user to verify page. If the death in service is no and there age
     * (calculated from their DOB) is less than 116 then we send the user to verify page. We calculate the age via the
     * _agePastThreshold() function.
     * A valid post is once again service to the session.
     *
     * @param ServiceDetailsSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function serviceDetailsSave(ServiceDetailsSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('service_details', $request->all());
		//dd($request->session()->get('service_details'));
		$request->session()->put('service_details.join_date', $this->_createDateString($request->session()->get('service_details.join_day'), $request->session()->get('service_details.join_month'), $request->session()->get('service_details.join_year')));
		$request->session()->put('service_details.discharge_date', $this->_createDateString($request->session()->get('service_details.discharge_day'), $request->session()->get('service_details.discharge_month'), $request->session()->get('service_details.discharge_year')));
		if($request->session()->get('death_in_service.death') == 'unknown') {
			return redirect('/verify');
		}
		if($request->session()->get('death_in_service.death') == 'No' && !$this->_agePastThreshold($request->session()->get('essential_information.dob'))) {
			return redirect('/verify');
		}
		return redirect('/your-details');
	}

    /**
     * Show the user the form for their details.
     * We load in a JSON list of countries, it not used unless the users browsers needs a fully accessible solution
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function yourDetails(Request $request)
	{
		$your_details = $request->session()->get('your_details');
		$countries = \Countries::getList('en', 'json');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-information', ['your_details' => $your_details, 'countries' => json_decode($countries, true)]);
	}

    /**
     * Show the use the form so they can choose their relationship with the service person, this choice will
     * have an affect on whether they are charged or not.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function relationship(Request $request)
	{
		$your_details_relationship = $request->session()->get('your_details.relationship');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-details-relationship', ['your_details_relationship' => $your_details_relationship]);
	}

    /**
     * The user will see this page if they have chosen that they are related to the serviceperson.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function relation(Request $request)
	{
		$your_details_relation = $request->session()->get('your_details.relation');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-details-relation', ['your_details_relation' => $your_details_relation]);
	}

    /**
     * Save the users details, these details will be sent to notify and if the user needs to make a payment we can use
     * the address should we need too.
     *
     * @param YourInformationSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function yourDetailsSave(YourInformationSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('your_details', $request->all());
		return redirect('/your-details/relation');
	}

    /**
     * We are processing the relation here, if they user is not related we can send them straight to the cehck your
     * answers page, if they are related we need some more information.
     *
     * @param RelationRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function yourDetailsRelationSave(RelationRequest $request)
	{
		$validated = $request->validated();

		$request->session()->put('your_details.relation', $request->all());
		if($request->input('related') == 'No') {
			$request->session()->put('your_details.payment_required', true);
			return redirect('/check-your-answers');
		} else {
			return redirect('/your-details/relationship');
		}

	}

    /**
     * Save the relationship of the user to the serviceperson, here we also work out if a payment is required or not.
     *
     * @param RelationshipRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function yourDetailsRelationshipSave(RelationshipRequest $request)
	{
		$validated = $request->validated();
		$free = ['Spouse/Civil Partner', 'Mother/Father'];
		$request->session()->put('your_details.relationship', $request->all());
		if(in_array($request->session()->get('your_details.relationship.relationship'), $free)) {
			$request->session()->put('your_details.payment_required', false);
		} else {
			$request->session()->put('your_details.payment_required', true);
		}
		return redirect('/check-your-answers');
	}

    /*
    public function yourDetailsCommunication(Request $request)
    {
        $communication = $request->session()->get('your_details.communication');
        //$referer = $request->server('HTTP_REFERER');
        return view('your-details-communication', ['communication' => $communication]);
    }
    public function youDetailsCommunicationSave(CommunicationRequest $request)
    {
        $validation = $request->validated();
        $request->session()->put('your_details.communication', $request->all());
        return redirect('/check-your-answers');
    }
    */

    /**
     * Serve the user with the vertification page, this is where proof of death. i.e. The death certificate is uploaded.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function verify(Request $request)
	{
		//$referer = $request->server('HTTP_REFERER');
		return view('verify');
	}

    /**
     * Process the upload, we accept images and PDFS, if an image is upload we basically create a PDF and insert the
     * image into the PDF this is so we can send the file using the notify api. There is currently at 2MB limit to files
     * that can be uploaded.
     *
     * @TODO: Take the 2MB limit off, and compress the file on upload
     *
     * @param VerifyRequestSave $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function verifySave(Request $request)
	{
        $validation = $request->validated();

        $path = Storage::disk('local')->put('verification', $request->file('certificate'));
        //dd($path);
        //$path = $request->file('certificate')->putFileAs('verification');
        $newPath = \Storage::disk('local')->path($path);
        if(strpos($request->file('certificate')->getMimeType(), "image") !== false) {
            $pdf = new Fpdf();
            $pdf->AddPage();
            $pdf->Image($newPath, 0, 0, -300);
            $newPath = \Storage::disk('local')->path('verification/' . $request->file('certificate')->hashName() . '.pdf');
            $pdf->Output('F', $newPath);
        }

        $verification = [
            'death_certificate' => $newPath,
            'uploaded' => 'Yes',
            'method' => $request->input('verify_method')
        ];

        $request->session()->put('verification', $verification);

        return redirect('/your-details');
	}

    /**
     * Serve the user with the check your answers page.
     *
     * @TODO: If a user changes, or checks and answer on clicking continue they need to return to the check your
     * answers page, not go through the process again.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function checkYourAnswers(Request $request)
	{
		$data = $request->session();
		//$referer = $request->server('HTTP_REFERER');
		return view('check-your-answers', ['data' =>  $data]);
	}

    /**
     * Create a date string from the partial day, month and year inputs we use.
     *
     * @todo Use something better than ?? for missing data.
     *
     * @param string $day
     * @param string $month
     * @param string $year
     * @return string
     */
	private function _createDateString($day, $month, $year)
	{
		if(!isset($day) || $day == "") {
			$day = "??";
		}
		if(!isset($month) || $month == "") {
			$month = "??";
		}
		if(!isset($year) || $year == "") {
			$year = "??";
		}

		return $day . "/" . $month . "/" . $year;
	}

    /**
     * Create a random reference number for each request, we use the force abbreviation, a time stand then the date, the
     * timestamp should make it unique, something like this will get created, SEA-1234567890-2020-03-12
     *
     * @param string $force
     * @return string
     */
	private function _createReference($force)
	{
		switch($force)
		{
			case 'Royal Navy / Royal Marines':
				$code = "SEA";
				break;
			case 'Army':
			case 'Home Guard':
				$code = "LAN";
				break;
			case 'Royal Air Force (RAF)':
				$code = "AIR";
				break;
			case 'Unknown':
				$code = "UNK";
				break;
		}

		return $code . '-' . time() . '-' . date('d-m-Y');
	}

    /**
     * Return a bool, as to whether or not the user needs to supply a death certificate. We take the DOB, make sure that
     * it is a valid date that does not contain ??. Parse the DOB in to a date format using Carbon, compare that to
     * todays date, if the difference is more than 116 years we return true and the user will not need to do an upload.]
     *
     * @param string $dob
     * @return bool
     */
	private function _agePastThreshold($dob)
	{
		if(strpos($dob, "?") !== false) {
			return false;
		}

		$validDate = Carbon::createFromFormat('d/m/Y', $dob);
		$age = Carbon::parse($validDate)->age;

		if($age >= 116) {
			return true;
		}
	}
}
