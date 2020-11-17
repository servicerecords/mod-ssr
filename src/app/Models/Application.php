<?php


namespace App\Models;


use Alphagov\Notifications\Exception\ApiException;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidPeriodParameterException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        ['label' => 'Service', 'field' => 'serviceperson-service', 'route' => 'service', 'change' => 'service branch'],
        ['label' => 'Service number', 'field' => 'serviceperson-service-number', 'route' => 'serviceperson-details', 'change' => 'service number'],
        ['label' => 'First name(s)', 'field' => 'serviceperson-first-name', 'route' => 'essential-information', 'change' => 'first name'],
        ['label' => 'Last name', 'field' => 'serviceperson-last-name', 'route' => 'essential-information', 'change' => 'last name'],
        ['label' => 'Place of birth', 'field' => 'serviceperson-place-of-birth', 'route' => 'essential-information', 'change' => 'place of birth'],
        ['label' => 'Date of birth', 'field' => 'serviceperson-date-of-birth-date', 'route' => 'essential-information', 'change' => 'date of birth'],
    ];

    private $questionOrder = [
        Constant::SERVICEPERSION => [
            ServiceBranch::NAVY => [
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details', 'change' => 'date they joined'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service', 'change' => 'if they died in service'],
                ['label' => 'Date of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details', 'change' => 'date they died in service'],
                ['label' => 'Further information', 'field' => 'serviceperson-discharged-information', 'route' => 'serviceperson-details', 'change' => 'further information'],
            ],
            ServiceBranch::ARMY => [
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service', 'change' => 'if they died in service'],
                ['label' => 'Year of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details', 'change' => 'year of death in service'],
                ['label' => 'Regt/Corps', 'field' => 'serviceperson-regiment', 'route' => 'serviceperson-details', 'change' => 'Regiment or Corps'],
                ['label' => 'Why they left the Army', 'field' => 'serviceperson-reason-for-leaving', 'route' => 'serviceperson-details', 'change' => 'why they left the Army'],
                ['label' => 'Territorial Army (TA)', 'field' => 'serviceperson-additional-service-ta', 'route' => 'serviceperson-details', 'change' => 'Territorial Army served'],
                ['label' => 'TA Number', 'field' => 'serviceperson-additional-service-ta-number', 'route' => 'serviceperson-details', 'change' => 'TA number'],
                ['label' => 'TA Regt/Corps', 'field' => 'serviceperson-additional-service-ta-regiment', 'route' => 'serviceperson-details', 'change' => 'TA Regiment or Corps'],
                ['label' => 'TA Dates', 'field' => 'serviceperson-additional-service-ta-dates-hint', 'route' => 'serviceperson-details', 'change' => 'TA Dates'],
                ['label' => 'Army Emergency Reserve (AER)', 'field' => 'serviceperson-additional-service-aer', 'route' => 'serviceperson-details', 'change' => 'AER served'],
                ['label' => 'AER Reserve Number', 'field' => 'serviceperson-additional-service-aer-number', 'route' => 'serviceperson-details', 'change' => 'AER Reserve number'],
                ['label' => 'AER Regt/Corps', 'field' => 'serviceperson-additional-service-aer-regiment', 'route' => 'serviceperson-details', 'change' => 'AER Regiment or Corps'],
                ['label' => 'AER Dates', 'field' => 'serviceperson-additional-service-aer-dates-hint', 'route' => 'serviceperson-details', 'change' => 'AER dates'],
                ['label' => 'Disability Pension been applied for', 'field' => 'serviceperson-disability-pension', 'route' => 'serviceperson-details', 'change' => 'if disability pension applied for'],
                ['label' => 'Further information', 'field' => 'serviceperson-additional-information', 'route' => 'serviceperson-details', 'change' => 'further information'],
            ],
            ServiceBranch::RAF => [
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details', 'change' => 'date they joined'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service', 'change' => 'if they died in service'],
                ['label' => 'Date of casualty / aircraft loss', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details', 'change' => 'date of casualty or aircraft loss'],
                ['label' => 'Further information', 'field' => 'serviceperson-discharged-information', 'route' => 'serviceperson-details', 'change' => 'further information'],
            ],
            ServiceBranch::HOME_GUARD => [
                ['label' => 'National Registration number', 'field' => 'serviceperson-service-number', 'route' => 'serviceperson-details', 'change' => 'national registration number'],
                ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted-date', 'route' => 'serviceperson-details', 'change' => 'date they joined'],
                ['label' => 'Died in service', 'field' => 'serviceperson-died-in-service', 'route' => 'death-in-service', 'change' => 'if they died in service'],
                ['label' => 'Date of death in service', 'field' => 'serviceperson-discharged-date', 'route' => 'serviceperson-details', 'change' => 'date of death in service'],
                ['label' => 'County they served in', 'field' => 'serviceperson-county-served', 'route' => 'serviceperson-details', 'change' => 'county they served in'],
                ['label' => 'Address when they joined', 'field' => 'serviceperson-address-when-joined', 'route' => 'serviceperson-details', 'change' => 'address when they joined'],
                ['label' => 'Numbers of any Battalions and Companies', 'field' => 'serviceperson-battalions', 'route' => 'serviceperson-details', 'change' => 'number of battalions and companies'],
            ],
        ],
        Constant::APPLICANT => [
            ['label' => 'Your full name', 'field' => 'applicant-name', 'route' => 'applicant-details', 'change' => 'your full name'],
            ['label' => 'Email address', 'field' => 'applicant-email-address', 'route' => 'applicant-details', 'change' => 'your email address'],
            ['label' => 'Building and street', 'field' => 'applicant-address-line-1', 'route' => 'applicant-details', 'change' => 'your building and street'],
            ['label' => 'Address Line 2', 'field' => 'applicant-address-line-2', 'route' => 'applicant-details', 'change' => 'your second address line'],
            ['label' => 'Town', 'field' => 'applicant-address-town', 'route' => 'applicant-details', 'change' => 'your town'],
            ['label' => 'Postcode', 'field' => 'applicant-address-postcode', 'route' => 'applicant-details', 'change' => 'your postcode'],
            ['label' => 'Country', 'field' => 'applicant-address-country', 'route' => 'applicant-details', 'change' => 'your country'],
            ['label' => 'Telephone Number', 'field' => 'applicant-telephone', 'route' => 'applicant-details', 'change' => 'your telephone number'],
            ['label' => 'Relationship to serviceperson', 'field' => 'applicant-relationship', 'route' => 'applicant-relationship', 'change' => 'relationship to serviceperson'],
            ['label' => 'Was spouse at death', 'field' => 'applicant-relationship-spouse-at-death', 'route' => 'applicant-relationship', 'change' => 'if you were their spouse at death'],
            ['label' => 'Parent confirmed no spouse', 'field' => 'applicant-relationship-no-surviving-spouse', 'route' => 'applicant-relationship', 'change' => 'if a parent confirmed no spouse'],
            ['label' => 'Is next of kin', 'field' => 'applicant-next-of-kin', 'route' => 'applicant-next-of-kin', 'change' => 'if you are their next of kin'],
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
                $responses[$responseKey]['value'] = session($response['field'], '');
            }

            if (session('serviceperson-died-in-service', Constant::YES) == 'Yes') {
                if (session('service') == ServiceBranch::HOME_GUARD) {
                    session('label-serviceperson-discharged', 'Date of death in service');
                } else {
                    session('label-serviceperson-discharged', 'Date of casualty / aircraft loss');
                }
            } else {
                session('label-serviceperson-discharged', 'Date they left');
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
            if (session($response['field'], '') == trim('')) {
                unset($responses[$responseKey]);
                continue;
            }

            $responses[$responseKey]['value'] = session($response['field'], '');

            switch (session('service', ServiceBranch::HOME_GUARD)) {
                case ServiceBranch::HOME_GUARD:
                    if ($response['label'] === 'Service number') {
                        $responses[$responseKey]['label'] = 'National Registration';
                    }
                    break;
            }

            if ($responses[$responseKey]['field'] === 'applicant-relationship') {
                if (session('applicant-relationship', Constant::RELATION_OTHER) === Constant::RELATION_OTHER) {
                    $responses[$responseKey]['value'] = session('applicant-relationship-other', '');
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
     * @return bool
     */
    public function deathCertificateRequired()
    {
        $diedInService = session('serviceperson-died-in-service', Constant::NO) === Constant::YES;
        $ageToDate = date('Y') - session('serviceperson-date-of-birth-date-year', date('Y'));

        return (!$diedInService || $ageToDate > 116);
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
        session(['section-complete' => session('section-complete', 0) | $section]);
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
            'dbs_branch' => $dbs_office = ServiceBranch::getInstance()->getServiceBranch(session('service')) ?? '',
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
        $reference = $code . '-' . time();

        session(['application-reference' => $reference]);

        return $reference;
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

    /**
     * Clear up the session
     */
    public function cleanup()
    {
        $reference = session('application-reference');

        if (session('death-certificate')) {
            Storage::delete(session('death-certificate'));
        }

        session()->flush();
        session(['application-reference' => $reference]);
    }

    /**
     * @param $currentSection
     */
    public function priorSectionComplete($currentSection)
    {
    }
}
