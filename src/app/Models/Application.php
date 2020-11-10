<?php


namespace App\Models;


use Alphagov\Notifications\Exception\ApiException;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidPeriodParameterException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use \Alphagov\Notifications\Client as Notify;
use Mockery\Exception;

class Application
{
    private static $instance = null;
    private $serviceperson = [];
    private $applicant = [];
    private $deathCertificate = false;

    private $standardQuestions = [
        ['label' => 'Service', 'field' => 'serviceperson-service', 'route' => 'service'],
        ['label' => 'Service number', 'field' => 'serviceperson-service-number', 'route' => 'serviceperson-details'],
        ['label' => 'First name(s)', 'field' => 'serviceperson-first-name', 'route' => 'essential-information'],
        ['label' => 'Last name', 'field' => 'serviceperson-last-name', 'route' => 'essential-information'],
        ['label' => 'Place of birth', 'field' => 'serviceperson-place-of-birth', 'route' => 'essential-information'],
        ['label' => 'Date of birth', 'field' => 'serviceperson-date-of-birth-date', 'route' => 'essential-information'],
    ];

    private $questionOrder = [
        Constant::SERVICEPERSION => [
            ServiceBranch::NAVY => [
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service'],
                ['label' => 'Date of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details'],
                ['label' => 'Further information', 'field' => 'serviceperson-discharged-information', 'route' => 'serviceperson-details'],
            ],
            ServiceBranch::ARMY => [
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service'],
                ['label' => 'Year of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details'],
                ['label' => 'Regt/Corps', 'field' => 'serviceperson-regiment', 'route' => 'serviceperson-details'],
                ['label' => 'Why they left the Army', 'field' => 'serviceperson-reason-for-leaving', 'route' => 'serviceperson-details'],
                ['label' => 'Territorial Army (TA)', 'field' => 'serviceperson-additional-service-ta', 'route' => 'serviceperson-details'],
                ['label' => 'TA Number', 'field' => 'serviceperson-additional-service-ta-number', 'route' => 'serviceperson-details'],
                ['label' => 'TA Regt/Corps', 'field' => 'serviceperson-additional-service-ta-regiment', 'route' => 'serviceperson-details'],
                ['label' => 'TA Dates', 'field' => 'serviceperson-additional-service-ta-dates-hint', 'route' => 'serviceperson-details'],
                ['label' => 'Army Emergency Reserve (AER)', 'field' => 'serviceperson-additional-service-aer', 'route' => 'serviceperson-details'],
                ['label' => 'AER Reserve Number', 'field' => 'serviceperson-additional-service-aer-number', 'route' => 'serviceperson-details'],
                ['label' => 'AER Regt/Corps', 'field' => 'serviceperson-additional-service-aer-regiment', 'route' => 'serviceperson-details'],
                ['label' => 'AER Dates', 'field' => 'serviceperson-additional-service-aer-dates-hint', 'route' => 'serviceperson-details'],
                ['label' => 'Disability Pension been applied for', 'field' => 'serviceperson-disability-pension', 'route' => 'serviceperson-details'],
                ['label' => 'Further information', 'field' => 'serviceperson-additional-information', 'route' => 'serviceperson-details'],
            ],
            ServiceBranch::RAF => [
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service'],
                ['label' => 'Date of casualty / aircraft loss', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details'],
                ['label' => 'Further information', 'field' => 'serviceperson-discharged-information', 'route' => 'serviceperson-details'],
            ],
            ServiceBranch::HOME_GUARD => [
                ['label' => 'National Registration number', 'field' => 'serviceperson-service-number', 'route' => 'serviceperson-details'],
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service'],
                ['label' => 'Date of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details'],
                ['label' => 'County did they serve in', 'field' => 'serviceperson-county-served', 'route' => 'serviceperson-details'],
                ['label' => 'Address when they joined', 'field' => 'serviceperson-address-when-joined', 'route' => 'serviceperson-details'],
                ['label' => 'Numbers of any Battalions and Companies', 'field' => 'serviceperson-battalions', 'route' => 'serviceperson-details'],
            ],
        ],
        Constant::APPLICANT => [
            ['label' => 'Your full name', 'field' => 'applicant-name', 'route' => 'applicant-details'],
            ['label' => 'Email address', 'field' => 'applicant-email-address', 'route' => 'applicant-details'],
            ['label' => 'Building and street', 'field' => 'applicant-address-line-1', 'route' => 'applicant-details'],
            ['label' => 'Address Line 2', 'field' => 'applicant-address-line-2', 'route' => 'applicant-details'],
            ['label' => 'Town', 'field' => 'applicant-address-town', 'route' => 'applicant-details'],
            ['label' => 'Postcode', 'field' => 'applicant-address-postcode', 'route' => 'applicant-details'],
            ['label' => 'Country', 'field' => 'applicant-address-country', 'route' => 'applicant-details'],
            ['label' => 'Telephone Number', 'field' => 'applicant-telephone', 'route' => 'applicant-details'],
            ['label' => 'Relationship to serviceperson', 'field' => 'applicant-relationship', 'route' => 'applicant-relationship'],
            ['label' => 'Was spouse at death', 'field' => 'applicant-relationship-spouse-at-death', 'route' => 'applicant-relationship'],
            ['label' => 'No surviving spouse', 'field' => 'applicant-relationship-no-surviving-spouse', 'route' => 'applicant-relationship'],
            ['label' => 'Is next of kin', 'field' => 'applicant-next-of-kin', 'route' => 'applicant-next-of-kin'],
        ]
    ];

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

            if ($sessionKey === 'death-certificate') {
                $this->deathCertificate = file_get_contents(storage_path($sessionValue));
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

    /**
     * @return array
     */
    public function getServiceperson()
    {
        $responses = array_merge(
            $this->standardQuestions,
            $this->questionOrder[Constant::SERVICEPERSION][session('service', ServiceBranch::ARMY)]
        );

        foreach ($responses as $responseKey => $response) {
            if (Str::endsWith($response['field'], '-date')) {
                $responses[$responseKey]['value'] = $this->generateDateString($response['field']);
            } else {
                $responses[$responseKey]['value'] = session($response['field'], 'n/a');
            }
        }

        return $responses;
    }

    /**
     * @return array
     */
    public function getApplicant()
    {
        $responses = $this->questionOrder[Constant::APPLICANT];

        foreach ($responses as $responseKey => $response) {
            if (session($response['field'], 'n/a') == trim('')) {
                unset($responses[$responseKey]);
                continue;
            }

            $responses[$responseKey]['value'] = session($response['field'], 'n/a');

            switch (session('service', ServiceBranch::HOME_GUARD)) {
                case ServiceBranch::HOME_GUARD:
                    if ($response['label'] === 'Service number') {
                        $responses[$responseKey]['label'] = 'National Registration';
                    }
                    break;
            }

            if ($responses[$responseKey]['field'] === 'applicant-relationship') {
                if (session('applicant-relationship', Constant::RELATION_OTHER) === Constant::RELATION_OTHER) {
                    $responses[$responseKey]['value'] = session('applicant-relationship-other', 'n/a');
                }
            }

        }

        return $responses;
    }

    /**
     * @return array
     */
    public function getServicepersionAnswers()
    {
        return $this->questionOrder;
    }

    /**
     * @return bool|string
     */
    public function getDeathCertificate()
    {
        return $this->deathCertificate;
    }

    /**
     * @return bool
     */
    public function isFree()
    {
        switch (session('applicant-relationship')) {
            case Constant::RELATION_SPOUSE:
                return true;
            case Constant::RELATION_PARENT:
                return session('applicant-relationship-no-surviving-spouse', true);
        }

        return false;
    }

    /**
     * @param $section
     * @return int
     */
    public function sectionComplete($section)
    {
        return (session('section-complete', 0) & $section);
    }

    /**
     * @param $section
     */
    public function markSectionInComplete($section)
    {
        return (session('section-complete', 0) & ~$section);
    }

    /**
     *
     */
    public function resetCompletedSections()
    {
        session(['section-complete' => 0]);
    }

    /**
     * @param $section
     */
    public function markSectionComplete($section)
    {
        session(['section-complete' => session('section->complete', 0) | $section]);
    }

    /**
     * Send notification to DBS Branch
     */
    public function notifyBranch()
    {
        $serviceBranch = ServiceBranch::getInstance();
        $templateId = $serviceBranch->getEmailTemplateId(session('service'));
        $notify = $this->getClient();
        $template = $notify->getTemplate($templateId);
        $data = [];

        if ($template) {
            $properties = $template['personalisation'];

            if (session('serviceperson-died-in-service', Constant::NO) == Constant::NO
                && session('death-certificate', false)) {
                session(['attachment' => $notify->prepareUpload(
                    file_get_contents(storage_path(session('death-certificate')))
                )]);
            }

            foreach ($properties as $property => $propertyValue) {
                if (session()->has($property)) {
                    $data[$property] = session($property, 'n/a');
                } else {
                    $data[$property] = 'n/a';
                }
            }
        }

        $response = $notify->sendEmail(
            ServiceBranch::getInstance()->getEmailAddress(session('service')),
            $templateId,
            $data,
            session('applicant-reference')
        );


    }

    /**
     * Send notification to applicant
     */
    public function notifyApplicant()
    {
        $templateId = '567f3c9f-4e9f-45b1-99ef-1d559c0f676d';
        $data = [
            'service_feedback_url' => env('APP_URL', 'http://srrdigital-sandbox.cloudapps.digital/feedback'),
            'dbs_branch' => $dbs_office = session('serviceperson-service') ?? '',
            'dbs_email' => ServiceBranch::getInstance()->getEmailAddress(session('service')) ?? '',
            'reference_number' => session('application-reference') ?? '',
        ];

        try {
            return $this->getClient()->sendEmail(
                session('applicant-email-address'),
                $templateId,
                $data);
        } catch (ApiException $e) {
            Log::critical($e->getErrorMessage());
            $failure = [
                'email' => session('applicant-email-address'),
                'template' => $templateId,
                'data' => $data,
            ];

            $failureFile = storage_path('app/notify/failure.json');
            $failures = json_decode(file_get_contents($failureFile));
            array_push($failures, $failure);
            file_put_contents($failureFile, json_encode($failures));

            return $e;
        }
    }

    /**
     * Create a unique reference for each new request.
     */
    public function createReference()
    {
        $code = ServiceBranch::getInstance()->getCode(session('service', ServiceBranch::ARMY));
        return $code . '-' . time() . '-' . date('d-m-Y');
    }

    /**
     * @param $field
     * @return string
     */
    protected function generateDateString($field)
    {
        $day = $month = $year = '';

        if ($field === 'serviceperson-date-of-birth-date') {
            $day = session('serviceperson-date-of-birth-date-day', Constant::DAY_PLACEHOLDER);
            $month = session('serviceperson-date-of-birth-date-month', Constant::MONTH_PLACEHOLDER);
            $year = session('serviceperson-date-of-birth-date-year', Constant::YEAR_PLACEHOLDER);
        } else {
            $fields = ServiceBranch::getInstance()->getFields(
                session('service', ServiceBranch::ARMY),
                session('servicepersion-died-in-service')
            );

            if (array_key_exists($field . '-day', array_flip($fields))) {
                $day = session($field . '-day', Constant::DAY_PLACEHOLDER);
            }

            if (array_key_exists($field . '-month', array_flip($fields))) {
                $month = session($field . '-month', Constant::MONTH_PLACEHOLDER);
            }

            if (array_key_exists($field . '-year', array_flip($fields))) {
                $year = session($field . '-year', Constant::YEAR_PLACEHOLDER);
            }
        }

        if (trim($day) == '') $day = Constant::DAY_PLACEHOLDER;
        else $day = sprintf('%02d', $day);

        if (trim($month) == '') $month = Constant::MONTH_PLACEHOLDER;
        else $month = sprintf('%02d', $month);

        if (trim($year) == '') $year = Constant::YEAR_PLACEHOLDER;
        else $year = sprintf('%04d', $year);

        if ($day !== Constant::DAY_PLACEHOLDER && $month !== Constant::MONTH_PLACEHOLDER && $year !== Constant::YEAR_PLACEHOLDER) {
            try {
                $date = Carbon::create($year, $month, $day);
                return $date->format('j F Y');
            } catch (Exception $e) {
            }
        }

        return $day . '-' . $month . '-' . $year;
    }

    /**
     * @return Notify
     */
    public function getClient()
    {
        return new Notify([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75'),
            'httpClient' => new Client()
        ]);
    }
}
