<?php

namespace App\Http\Controllers;

use Alphagov\Notifications\Exception\ApiException;
use Alphagov\Notifications\Exception\NotifyException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfirmationController extends Controller
{
    protected $land_email;
    protected $sea_email;
    protected $air_email;
    protected $accounts_email;
    protected $unknown_email;
    protected $templates;

    public function __construct()
    {
        $fallbackEmail = 'lauren.phillips225@mod.gov.uk';

        $this->land_email = env('LAND_EMAIL', $fallbackEmail);
        $this->sea_email = env('SEA_EMAIL', $fallbackEmail);
        $this->air_email = env('AIR_EMAIL', $fallbackEmail);
        $this->accounts_email = env('ACCOUNTS_EMAIL', $fallbackEmail);
        $this->unknown_email = env('UNKNOWN_EMAIL', $fallbackEmail);
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

    /**
     * Determine if the payment was successful or not and show the correct view based on that value.
     * We use a parameter in the URL called uuid to get the payment ID from the session which is stored again this UUID.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (null === $request->get('uuid')) {
            $success = true;
        } else {
            $success = $this->_checkPayment($request);
        }

        if ($success !== true) {
            return view('process_error', ['message' => $success['message']]);
        }

        $searchNotificationResponse = $this->_sendSearchNotification($request);
        if (!is_array($searchNotificationResponse)) {
            return view('process_error');
        }

        $this->_sendCustomerNotification($request);

        $dbs_office = $request->session()->get('dbs_office') ?? '';
        $reference = $request->session()->get('reference') ?? '';
        $request->session()->flush();
        return view('confirmation', ['dbs_team' => $dbs_office, 'reference' => $reference]);
    }

    private function _checkPayment($request)
    {
        $client = new Client([
            'base_uri' => 'https://publicapi.payments.service.gov.uk/v1/',
            'timeout' => 30.0,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('GOV_PAY_API_KEY', 'kiaer1kpiaolo3m7hc13p2jln7anjhi4v0ggcgluu1jqek4kr4pajq7cu4'),
                'Content-Type' => 'application/json'
            ]
        ]);

        try {
            $paymentId = $request->session()->get($request->get('uuid'), 'UNKNOWN');
            $response = $client->get('payments/' . $paymentId);
            $body = json_decode($response->getBody()->getContents());

            if ($body->state->status === 'success') {
                return true;
            }

            if (isset($response->state) && !isset($response->state->message)) {
                Log::error('PAY ERR: ' . __LINE__ . '::' . $response->state->message);
                return [
                    'message' => 'There was an error with your payment please contact xxx xxxxxx and use your reference ' . $request->session()->get('reference')
                ];
            }

            Log::error('PAY ERR: ' . __LINE__ . '::' . $response->state->message);
            return [
                'message' => $response->state->message
            ];

        } catch (GuzzleException $e) {
            Log::critical($e->getMessage());
            return false;
        }
    }

    /**
     * Send the notification to the DBS office, we pass in most of the session data, this gets replaced on Notify's side
     * @param $request
     * @return NotifyException|array|\Exception
     */
    private function _sendSearchNotification(Request $request)
    {
        switch ($request->session()->get('service', 'Unknown')) {
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

        if ($request->session()->get('death_in_service.death') == 'Yes') {
            $template_shortcode = $template_shortcode . '_DIS';
        }

        $upload = '';
        if (null !== $request->session()->get('verification.death_certificate')) {
            $file_data = file_get_contents($request->session()->get('verification.death_certificate'));
            $upload = $notifyClient->prepareUpload($file_data);
        }

        try {
            $response = $notifyClient->sendEmail(
                $emails,
                $this->templates[$template_shortcode],
                [
                    'reference' => $request->session()->get('reference') ?? '',
                    'firstname' => $request->session()->get('essential_information.firstnames') ?? '',
                    'lastname' => $request->session()->get('essential_information.lastname') ?? '',
                    'dob' => $request->session()->get('essential_information.dob') ?? '',
                    //'dob_accurate' => $request->session()->get('essential_information.dob_accurate'),
                    'date_joined' => $request->session()->get('service_details.join_date', '??/??/??'),
                    'unit' => $request->session()->get('service') ?? '',
                    'service_number' => $request->session()->get('service_details.service_number') ?? '',
                    'death_in_service' => $request->session()->get('death_in_service.death',) ?? '',
                    'date_of_death' => $request->session()->get('service_details.discharge_date',) ?? '',
                    'further_information' => $request->session()->get('essential_information.further_information',) ?? '',
                    'request_full_name' => $request->session()->get('your_details.fullname',) ?? '',
                    'request_address' => $request->session()->get('your_details.address_line_1',) ?? '',
                    'battalions_companies' => $request->session()->get('service_details.battalions_companies',) ?? '',
                    'county' => $request->session()->get('service_details.county',) ?? '',
                    'address' => $request->session()->get('service_details.address',) ?? '',
                    'discharge_address' => $request->session()->get('service_details.discharge_address',) ?? '',
                    // add address line 2
                    'postcode' => $request->session()->get('your_details.address_postcode',) ?? '',
                    'country' => $request->session()->get('your_details.address_county', ''),
                    'related' => $request->session()->get('your_details.relation.related',) ?? '',
                    'relationship' => $request->session()->get('your_details.relationship.relationship',) ?? '',
                    'next_of_kin' => ($request->session()->get('your_details.relationship.next_of_kin') !== 'Yes' ? 'No' : 'Yes'),
                    'email' => $request->session()->get('your_details.email',) ?? '',
                    'telephone' => $request->session()->get('your_details.telephone',) ?? '',
                    'payment_status' => (null !== $request->session()->get($request->get('uuid')) ? 'Paid' : 'No payment was required'),
                    'verification' => $request->session()->get('verification.uploaded',) ?? '',
                    'link_to_verification' => $upload,
                    'reason_for_leaving' => (null !== ($request->session()->get('service_details.leave_army_reason')) ? $request->session()->get('service_details.leave_army_reason') : '-'),
                    'further_service' => (null !== ($request->session()->get('service_details.completion_ifo')) ? implode(",", $request->session()->get('service_details.completion_ifo')) : '-'),
                    'leave_army_reason_other' => (null !== ($request->session()->get('service_details.leave_army_reason_other')) ? $request->session()->get('service_details.leave_army_reason_other') : '-')
                ],
                $request->session()->get('reference')
            );

            return $response;
        } catch (ApiException $e) {
            Log::critical($e->getErrorMessage());
            return $e;
        }
    }

    /**
     * Send the customer notification, we use the customer notification template, and pass the reference in as the only
     * data.
     *
     * @param $request
     * @return array|\Exception
     */
    private function _sendCustomerNotification($request)
    {
        $notifyClient = new \Alphagov\Notifications\Client([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);

        try {
            $response = $notifyClient->sendEmail(
                $request->session()->get('your_details.email'),
//                'cb31d5be-1f34-4546-bb1e-a784dcd2f390',
                '567f3c9f-4e9f-45b1-99ef-1d559c0f676d',
                [
                    'service_feedback_url' => env('APP_URL', 'http://srrdigital-sandbox.cloudapps.digital/feedback'),
                    'dbs_branch' => $dbs_office = $request->session()->get('dbs_office') ?? '',
                    'dbs_email' => $request->session()->get('dbs_email'),
                    'reference_number' => $request->session()->get('reference'),
                ]);
            return $response;
        } catch (ApiException $e) {
            Log::critical($e->getErrorMessage());
            return $e;
        }
    }
}
