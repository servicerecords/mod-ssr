<?php

namespace App\Http\Controllers;

use Alphagov\Notifications\Exception\NotifyException;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Alphagov\Notifications\Client as Notify;
use Illuminate\Support\Facades\Storage;

class ConfirmationController extends Controller
{
    //
	protected $land_email;
	protected $sea_email;
	protected $air_email;
	protected $accounts_email;
	protected $unknown_email;
	protected $templates;

	public function __construct()
	{
		$this->land_email = env('LAND_EMAIL', 'ainley87simon+land@gmail.com');
		$this->sea_email = env('SEA_EMAIL', 'ainley87simon+sea@gmail.com');
		$this->air_email = env('AIR_EMAIL', 'ainley87simon+air@gmail.com');
		$this->accounts_email = env('ACCOUNTS_EMAIL', 'ainley87simon+accounts@gmail.com');
		$this->unknown_email = env('UNKNOWN_EMAIL', 'ainley87simon+land@gmail.com');
		$this->templates = [
			'ARM_DIS' => '5f3a549b-9019-4c7f-8995-fb47ae4905bd',
			'ARM' => 'c811ac5c-cd6f-4702-8db5-ff105e364277',
			'RAF' => '9f2603ce-2bd0-4bc4-868b-72a3c066b10a',
			'RAF_DIS' => 'debb071c-90be-4254-898f-31ab28c58f3d',
			'HOM' => 'f61949e7-4a5e-4d2d-8264-bbbf5e25ddfc',
			'HOM_DIS' => 'a4cae06b-1ac7-4f9e-97ea-1b6f47e147c9',
			'SEA' => 'df015c4f-0f1b-4559-9f2d-c37624590c8d',
			'SEA_DIS' => 'edd45189-db4c-4b20-a5c8-a7490a4439e8'
		];
	}

	public function index(Request $request)
	{
		$response = $this->_sendSearchNotification($request);
		if(is_object($response) && $response->getCode() !== 200) {
			return view('process_error');
		} else {
			$dbs_office = $request->session()->get('dbs_office');
			$reference = $request->session()->get('reference');
			$response = $this->_sendCustomerNotification($request);

			$request->session()->flush();

			return view('confirmation', ['dbs_team' => $dbs_office, 'reference' => $reference]);
		}
	}

	private function _sendCustomerNotification($request) {

//	    $notifyClient = new Notify([
//            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
//            'httpClient' => new \Http\Adapter\Guzzle6\Client
//        ]);

        $notifyClient = new \Alphagov\Notifications\Client([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);

        try {
            $response = $notifyClient->sendEmail(
                $request->session()->get('your_details.email'),
                'cb31d5be-1f34-4546-bb1e-a784dcd2f390',
                [
                    'reference' => $request->session()->get('reference'),
                ]);
            return $response;
        } catch(\Exception $e) {
            return $e;
        }


    }

	private function _sendSearchNotification($request)
	{
		//die(print_r($service));
		switch($request->session()->get('service')) {
			case 'Royal Navy / Royal Marines':
				$emails = $this->sea_email;
				$request->session()->put('dbs_office', 'Navy');
				$template_shortcode = 'SEA';
				break;
			case 'Army':
				$emails = $this->land_email;
				$request->session()->put('dbs_office', 'Army');
				$template_shortcode = 'ARM';
				break;
			case 'Home Guard':
				$emails = $this->land_email;
				$request->session()->put('dbs_office', 'Army');
				$template_shortcode = 'HOM';
				break;
			case 'Royal Air Force (RAF)':
				$emails = $this->air_email;
				$request->session()->put('dbs_office', 'Airforce');
				$template_shortcode = 'RAF';
				break;
			case 'Unknown':
				$emails = $this->unknown_email;
				$request->session()->put('dbs_office', 'Army');
				$template_shortcode = 'UNK';
				break;
		}

        $notifyClient = new \Alphagov\Notifications\Client([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);

		if($request->session()->get('death_in_service.death') == 'Yes') {
			$template_shortcode = $template_shortcode . '_DIS';
		}

		if(null !== $request->session()->get('verification.death_certificate')){
			$file_data = file_get_contents($request->session()->get('verification.death_certificate'));
			$upload = $notifyClient->prepareUpload($file_data);
		} else {
			$upload = '';
		}

		try {
			$response = $notifyClient->sendEmail(
				$emails,
				$this->templates[$template_shortcode],
				[
					'reference' => $request->session()->get('reference'),
					'firstname' => $request->session()->get('essential_information.firstnames'),
					'lastname' => $request->session()->get('essential_information.lastname'),
					'dob' => $request->session()->get('essential_information.dob'),
					//'dob_accurate' => $request->session()->get('essential_information.dob_accurate'),
					'date_joined' => (null === $request->session()->get('essential_information.join_date') ? '??/??/??' : $request->session()->get('essential_information.join_date')),
					'unit' => $request->session()->get('service'),
					'service_number' => (null === $request->session()->get('service_details.service_number') ? '' : $request->session()->get('service_details.service_number')),
					'death_in_service' => (null === $request->session()->get('death_in_service.death') ? '' : $request->session()->get('death_in_service.death')),
					'date_of_death' => (null === $request->session()->get('service_details.discharge_date') ? '' : $request->session()->get('service_details.discharge_date')),
					'further_information' => (null === $request->session()->get('essential_information.further_information') ? '' : $request->session()->get('essential_information.further_information')),
					'request_full_name' => (null === $request->session()->get('your_details.fullname') ? '' : $request->session()->get('your_details.fullname')),
					'request_address' => (null === $request->session()->get('your_details.address_line_1') ? '' : $request->session()->get('your_details.address_line_1')),
					// add address line 2
					'postcode' => (null === $request->session()->get('your_details.address_postcode') ? '' : $request->session()->get('your_details.address_postcode')),
					'country' => (null === $request->session()->get('your_details.address_county') ? '' : $request->session()->get('your_details.address_county')),
					'related' => (null === $request->session()->get('your_details.relation.related') ? '' : $request->session()->get('your_details.relation.related')),
					'relationship' => (null === $request->session()->get('your_details.relationship.relationship') ? '' : $request->session()->get('your_details.relationship.relationship')),
					'next_of_kin' => ($request->session()->get('your_details.relationship.next_of_kin') !== 'Yes' ? 'No' : 'Yes'),
					'payment_status' => (null !== $request->session()->get('payment_id') ? 'Paid' : 'No payment was required'),
					'verification' => (null === $request->session()->get('verification.uploaded') ? '' : $request->session()->get('verification.uploaded')),
					'link_to_verification' => $upload,
					'reason_for_leaving' => (null !== ($request->session()->get('service_details.leave_army_reason')) ? implode(",", $request->session()->get('service_details.leave_army_reason')) : '-'),
					'further_service' => (null !== ($request->session()->get('service_details.completion_ifo')) ? implode(",", $request->session()->get('service_details.completion_ifo')) : '-'),
					'leave_army_reason_other' => (null !== ($request->session()->get('service_details.leave_army_reason_other')) ? $request->session()->get('service_details.leave_army_reason_other') : '-')
				],
				$request->session()->get('reference')
			);
			return $response;
		} catch (NotifyException $e){
			return $e;
		}
	}
}
