<?php


namespace App\Models;


use Illuminate\Support\Str;

class Serviceperson
{
    private static $instance = null;
    private $fields = [
        ['label' => '', 'field' => '', 'change' => '', 'route' => '']
    ];
    private $formFields = [
        ['label' => 'Which service did they last serve in?', 'field' => 'serviceperson-service'],
        ['label' => 'Did they die in service?', 'field' => 'serviceperson-died-in-service'],
        ['label' => 'First name(s)', 'field' => 'serviceperson-first-name'],
        ['label' => 'Last name', 'field' => 'serviceperson-last-name'],
        ['label' => 'Place of birth', 'field' => 'serviceperson-place-of-birth', 'mandatory' => false],
        ['label' => 'Date of birth', 'field' => 'serviceperson-date-of-birth'],
        ['label' => 'Day', 'field' => 'serviceperson-date-of-birth-day'],
        ['label' => 'Month', 'field' => 'serviceperson-date-of-birth-month'],
        ['label' => 'Year', 'field' => 'serviceperson-date-of-birth-year'],

        // NAVY SIS/DIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged-information', 'mandatory' => false],
        // NAVY SIS/DIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => 'Date they joined', 'field' => 'serviceperson-enlisted', 'mandatory' => false],
        ['label' => 'Date of death in service ', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged-information', 'mandatory' => false],

        // ARMY SIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-regiment', 'mandatory' => false],

        // ARMY DIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-regiment', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-reason-for-leaving', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-ta-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-ta-regiment', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-ta-date', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-aer-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-aer-regiment', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-service-aer-date', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-disability-pension', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-additional-information', 'mandatory' => false],

        // RAF SIS/DIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-enlisted', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged-information', 'mandatory' => false],

        // HOME_GUARD SIS/DIS
        ['label' => 'Official Service number', 'field' => 'serviceperson-service-number', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-discharged', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-county-served', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-address-when-joined', 'mandatory' => false],
        ['label' => '', 'field' => 'serviceperson-battalions', 'mandatory' => false],
    ];

    /**
     * Application constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Application|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Serviceperson();
        }

        $service = session('service');
        $diedInService = session('serviceperson-died-in-service', Constant::YES) === Constant::YES;

        array_merge(self::$fields, ServiceBranch::getInstance()->getFields($service, $diedInService));


        return self::$instance;
    }

    public function getServiceperson()
    {
        dd(session()->all());

        $serviceBranch = ServiceBranch::getInstance();
        $serviceNumber = session('service') === ServiceBranch::HOME_GUARD
            ? 'National Registration number' : 'Official Service number';

        $sections = [];
        array_push($sections, ['name' => 'Service', 'value' => $serviceBranch->getName(session('serviceperson-service')), 'action' => '']);
        array_push($sections, ['name' => $serviceNumber, 'value' => session('serviceperson-service-number'), 'action' => $serviceNumber, 'route' => '']);
        array_push($sections, ['name' => 'Died in service', 'value' => session('serviceperson-died-in-service'), 'action' => '']);
        array_push($sections, ['name' => 'First names', 'value' => session('serviceperson-first-name'), 'action' => '']);
        array_push($sections, ['name' => 'Last name', 'value' => session('serviceperson-last-name'), 'action' => '']);
        array_push($sections, ['name' => '', 'value' => session('serviceperson-service'), 'action' => '']);
        array_push($sections, ['name' => '', 'value' => session('serviceperson-service'), 'action' => '']);

//        foreach ($sessionValues as $sessionKey => $sessionValue) {
//            if (Str::startsWith($sessionKey, 'serviceperson')) {
//                $this->serviceperson[$s]
//            }
//        }


        return [];
    }

    /**
     * @return string
     */
    public function dateOfBirth()
    {
        $day = session('serviceperson-date-of-birth-day', Constant::DAY_PLACEHOLDER);
        $month = session('serviceperson-date-of-birth-month', Constant::MONTH_PLACEHOLDER);
        $year = session('serviceperson-date-of-birth-year', Constant::YEAR_PLACEHOLDER);

        return $this->readableDate($day, $month, $year);
    }

    /**
     * @param $day
     * @param $month
     * @param $year
     * @return string
     */
    protected function readableDate($day, $month, $year)
    {
        if ($day !== Constant::DAY_PLACEHOLDER) $day = sprintf('%02d', $day);
        if ($month !== Constant::MONTH_PLACEHOLDER) $month = sprintf('%02d', $month);
        if ($year !== Constant::YEAR_PLACEHOLDER) $year = sprintf('%04d', $year);

        return "{$day}/{$month}/{$year}";
    }

    /**
     *
     */
    protected function addField($label, $field, $change, $route)
    {
        array_push($this->fields,
            [
                'label' => '', 'field' => '',
                'change' => '', 'route' => ''
            ]
        );
    }
}
