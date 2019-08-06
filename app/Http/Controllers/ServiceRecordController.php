<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunicationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\DeathInServiceSave;
use App\Http\Requests\EssentialInformationSave;
use App\Http\Requests\RecordRequestSave;
use App\Http\Requests\ServiceChoiceSave;
use App\Http\Requests\ServiceDetailsSave;
use App\Http\Requests\YourInformationSave;
use App\Http\Requests\RelationRequest;
use App\Http\Requests\RelationshipRequest;

class ServiceRecordController extends Controller
{
    public function index()
	{
		return view('welcome');
	}

	public function recordRequest(Request $request)
	{
		//$referrer = $request->server('HTTP_REFERER');
		return view('request');
	}

	public function recordRequestSave(RecordRequestSave $request)
	{
		//We can just redirect for now as we don't need to save anything
		return redirect('/service');
	}

	public function serviceChoice(Request $request)
	{
		$service = $request->session()->get('service');
		//$referer = $request->server('HTTP_REFERER');
		return view('service', ['service' => $service]);
	}

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

	public function deathInService(Request $request)
	{
		$death_in_service = $request->session()->get('death_in_service');
		//$referer = $request->server('HTTP_REFERER');
		return view('deathInService', ['death_in_service' => $death_in_service]);
	}

	public function deathInServiceSave(DeathInServiceSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('death_in_service', $request->all());
		return redirect('/essential-information');
	}

	public function essentialInformation(Request $request)
	{
		$essential_information = $request->session()->get('essential_information');
		//$referer = $request->server('HTTP_REFERER');
		return view('essentialInformation', ['essential_information' => $essential_information]);
	}

	public function essentialInformationSave(EssentialInformationSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('essential_information', $request->all());
		$request->session()->put('essential_information.dob', $this->_createDateString($request->session()->get('essential_information.dob_day'), $request->session()->get('essential_information.dob_month'), $request->session()->get('essential_information.dob_year')));
		return redirect('/service-details');
	}

	public function serviceDetails(Request $request)
	{
		//die(print_r($request->session()));
		//$referer = $request->server('HTTP_REFERER');
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
			case "Unknown":
				$template = "their-details-unknown";
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

	public function serviceDetailsSave(ServiceDetailsSave $request)
	{
		//dd($request->all());
		//die(print_r($request->session()));
		$validated = $request->validated();

		$request->session()->put('service_details', $request->all());
		//dd($request->session()->get('service_details'));
		$request->session()->put('service_details.join_date', $this->_createDateString($request->session()->get('service_details.join_day'), $request->session()->get('service_details.join_month'), $request->session()->get('service_details.join_year')));
		$request->session()->put('service_details.discharge_date', $this->_createDateString($request->session()->get('service_details.discharge_day'), $request->session()->get('service_details.discharge_month'), $request->session()->get('service_details.discharge_year')));
		if($request->session()->get('death_in_service.death') != 'Yes') {
			return redirect('/verify');
		}
		return redirect('/your-details');
	}

	public function yourDetails(Request $request)
	{
		$your_details = $request->session()->get('your_details');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-information', ['your_details' => $your_details]);
	}

	public function relationship(Request $request)
	{
		$your_details_relationship = $request->session()->get('your_details.relationship');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-details-relationship', ['your_details_relationship' => $your_details_relationship]);
	}

	public function relation(Request $request)
	{
		$your_details_relation = $request->session()->get('your_details.relation');
		//$referer = $request->server('HTTP_REFERER');
		return view('your-details-relation', ['your_details_relation' => $your_details_relation]);
	}

	public function yourDetailsSave(YourInformationSave $request)
	{
		$validated = $request->validated();

		$request->session()->put('your_details', $request->all());
		return redirect('/your-details/relation');
	}

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

	public function verify(Request $request)
	{
		//$referer = $request->server('HTTP_REFERER');
		return view('verify');
	}

	public function verifySave(Request $request)
	{
		if($request->input('verify_method') == 'post') {
			$verification = [
				'uploaded' => 'No',
				'method' => $request->input('verify_method')
			];
			$request->session()->put('verification', $verification);
			return redirect('/your-details');
		}
		$path = $request->file('certificate')->store('verification');
		$verification = [
			'death_certificate' => $path,
			'uploaded' => 'Yes',
			'method' => $request->input('verify_method')
		];
		$request->session()->put('verification', $verification);
		return redirect('/your-details');
	}

	public function checkYourAnswers(Request $request)
	{
		$data = $request->session();
		//$referer = $request->server('HTTP_REFERER');
		return view('check-your-answers', ['data' =>  $data]);
	}

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
}
