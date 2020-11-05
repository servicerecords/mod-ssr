<?php


namespace App\Models;


use GuzzleHttp\Client;
use Illuminate\Support\Str;
use \Alphagov\Notifications\Client as Notify;
use Ramsey\Uuid\Uuid;

class Application
{
    private $serviceperson = [];

    private $applicant = [];

    private static $instance = null;

    /**
     * Application constructor.
     */
    private function __construct()
    {
        $session = session()->all();
        foreach ($session as $sessionKey => $sessionValue) {
            if (Str::startsWith($sessionKey, 'serviceperson-')) {
                $this->serviceperson[$sessionKey] = $sessionValue;
                continue;
            }

            if (Str::startsWith($sessionKey, 'applicant-')) {
                $this->applicant[$sessionKey] = $sessionValue;
                continue;
            }
        }
    }

    /**
     * @return Application|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Application();
        }

        return self::$instance;
    }

    public function getServiceperson()
    {
//        dd(session()->all());

//        $serviceBranch = ServiceBranch::getInstance();
//        $serviceNumber = session('service') === ServiceBranch::HOME_GUARD
//            ? 'National Registration number' : 'Official Service number';
//
//        $sections = [];
//        array_push($sections, ['name' => 'Service', 'value' => $serviceBranch->getName(session('serviceperson-service')), 'action' => '']);
//        array_push($sections, ['name' => $serviceNumber, 'value' => session('serviceperson-service-number'), 'action' => $serviceNumber]);
//        array_push($sections, ['name' => 'Died in service', 'value' => session('serviceperson-died-in-service'), 'action' => '']);
//        array_push($sections, ['name' => 'First names', 'value' => session('serviceperson-first-name'), 'action' => '']);
//        array_push($sections, ['name' => 'Last name', 'value' => session('serviceperson-last-name'), 'action' => '']);
//        array_push($sections, ['name' => '', 'value' => session('serviceperson-service'), 'action' => '']);
//        array_push($sections, ['name' => '', 'value' => session('serviceperson-service'), 'action' => '']);


        return $this->serviceperson;
    }

    public function getApplicant()
    {
        return $this->applicant;
    }

    /**
     * @return bool
     */
    public function isFree()
    {
        switch (session('applicant.applicant-relationship')) {
            case Constant::RELATION_SPOUSE:
                return true;
            case Constant::RELATION_PARENT:
                return session('applicant-relationship-no-surviving-spouse', true);
        }

        return false;
    }

    /**
     * Send notification to DBS Branch
     */
    public function notifyBranch()
    {
        $templateId = '68640434-bc34-4c0c-b8d4-de6d734661c6';
        $serviceBranch = ServiceBranch::getInstance();
        $template = $serviceBranch->getEmailTemplate(
            session('serviceperson-service')
        );

        $notify = new Notify([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
//            'httpClient' => new \Http\Adapter\Guzzle6\Client
            'httpClient' => new Client()
        ]);

        $template = $notify->getTemplate('68640434-bc34-4c0c-b8d4-de6d734661c6');




        $notify = new Notify([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
            'httpClient' => new Client()
        ]);
        $template = $notify->getTemplate($templateId);
        $data = [];
        if($template) {
            $properties = $template['personalisation'];

            foreach($properties as $property => $propertyValue) {
                $data[$property] = session($property, 'n/a');
            }
        }

        $response = $notify->sendEmail(
            'toby@codesure.co.uk',
            $templateId,
            $data,
            session('applicant-reference')
        );


//        $data = [
//            'reference'               =>  session('reference',                                 ''),
//            'firstname'               =>  session('serviceperson-firstname',                   ''),
//            'lastname'                =>  session('serviceperson-lastname',                    ''),
//            'dob'                     =>  session('serviceperson-date-of-birth',               ''),
//            'date_joined'             =>  session('service_details.join_date',                 '--/--/----'),
//            'unit'                    =>  session('serviceperson-service',                     ''),
//            'service_number'          =>  session('service_details.service_number',            ''),
//            'death_in_service'        =>  session('death_in_service.death',                    ''),
//            'date_of_death'           =>  session('service_details.discharge_date',            ''),
//            'further_information'     =>  session('essential_information.further_information', ''),
//            'request_full_name'       =>  session('applicant-name',                            ''),
//            'request_address'         =>  session('applicant.address_line_1',                  ''),
//            'battalions_companies'    =>  session('service_details.battalions_companies',      ''),
//            'county'                  =>  session('service_details.county',                    ''),
//            'address'                 =>  session('service_details.address',                   ''),
//            'discharge_address'       =>  session('service_details.discharge_address',         ''),
//
//            // add address line 2
//            'postcode'                =>  session('applicant-address_postcode',                ''),
//            'country'                 =>  session('applicant-address_county',                  ''),
//            'related'                 =>  session('applicant-relation.related',                ''),
//            'relationship'            =>  session('applicant-relationship',                    ''),
//            'next_of_kin'             =>  session('applicant-next-of-kin',                     Constant::YES),
//            'email'                   =>  session('applicant-email-address',                   ''),
//            'telephone'               =>  session('applicant-telephone',                       ''),
//            'payment_status'          =>  session(request()->get('uuid'), false) ? 'Paid' : 'No payment was required'),
//            'verification'            =>  session('verification.uploaded', ''),
//            'link_to_verification'    =>  $upload,
//            'reason_for_leaving'      =>  (null !== (session('service_details.leave_army_reason')) ? session('service_details.leave_army_reason') : '-'),
//            'further_service'         =>  (null !== (session('service_details.completion_ifo')) ? implode(",", session('service_details.completion_ifo')) : '-'),
//            'leave_army_reason_other' =>  (null !== (session('service_details.leave_army_reason_other')) ? session('service_details.leave_army_reason_other', '-')
//        ];

        if (!session('serviceperson-died-in-service') && session('death-certificate')) {
            $fileAttachment = $client->prepareUpload(
                file_get_contents(storage_path(session('death-certificate')))
            );
        }
    }

    /**
     * Send notification to applicant
     */
    public function notifyApplicant()
    {
    }

    /**
     * Create a unique reference for each new request.
     */
    protected function createReference()
    {
        switch (session('serviceperson-service')) {
            case ServiceBranch::ARMY:
                break;
            case ServiceBranch::NAVY:
                break;
            case ServiceBranch::NAVY:
                break;
            case ServiceBranch::NAVY:
                break;
        }
    }
}
