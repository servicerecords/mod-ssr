<?php


namespace App\Models;


class ServiceBranch
{
    private const FALLBACK_EMAIL = 'lauren.phillips225@mod.gov.uk';
    public  const NAVY           = 'NAVY';
    public  const RAF            = 'RAF';
    public  const ARMY           = 'ARMY';
    public  const HOME_GUARD     = 'HOME_GUARD';
    private static $instance     = null;

    /**
     * @var array[]
     */
    private $branches = [];

    /**
     * ServiceBranch constructor.
     */
    private function __construct()
    {
        $this->branches = [
            self::NAVY => [
                'NAME' => 'Royal Navy or Royal Marines',
                'SERVICE_BRANCH' => 'Royal Navy',
                'VALUE' => self::NAVY,
                'CODE' => 'SEA',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-discharged-information'
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-discharged-information',
                    ]
                ],
                'EMAIL_TEMPLATE' => 'e06c9e67-53c6-442e-962c-770b760ffc78',
                'EMAIL_ADDRESS' => env('SEA_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::ARMY => [
                'NAME' => 'Army (including Territorial & Army Emergency Reserve)',
                'SERVICE_BRANCH' => 'British Army',
                'VALUE' => self::ARMY,
                'CODE' => 'LAN',
                'FIELDS' => [
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-regiment',
                    ],
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-regiment',
                        'serviceperson-reason-for-leaving',
                        'serviceperson-additional-service-ta',
                        'serviceperson-additional-service-ta-number',
                        'serviceperson-additional-service-ta-regiment',
                        'serviceperson-additional-service-ta-dates',
                        'serviceperson-additional-service-aer',
                        'serviceperson-additional-service-aer-number',
                        'serviceperson-additional-service-aer-regiment',
                        'serviceperson-additional-service-aer-dates',
                        'serviceperson-disability-pension',
                        'serviceperson-additional-information'
                    ]
                ],
                'EMAIL_TEMPLATE' => '68640434-bc34-4c0c-b8d4-de6d734661c6',
                'EMAIL_ADDRESS' => env('LAND_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::RAF => [
                'NAME' => 'Royal Air Force (RAF)',
                'SERVICE_BRANCH' => 'Royal Air Force',
                'VALUE' => self::RAF,
                'CODE' => 'AIR',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-discharged-information'
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                        'serviceperson-discharged-information'
                    ]
                ],
                'EMAIL_TEMPLATE' =>'f8c75425-34bd-4322-8bb2-7081066175df',
                'EMAIL_ADDRESS' => env('AIR_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::HOME_GUARD => [
                'NAME' => 'Home Guard',
                'SERVICE_BRANCH' => 'British Army',
                'VALUE' => self::HOME_GUARD,
                'CODE' => 'LAN',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-county-served',
                        'serviceperson-address-when-joined',
                        'serviceperson-battalions',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-county-served',
                        'serviceperson-address-when-joined',
                        'serviceperson-battalions',
                        'serviceperson-enlisted-date-day',
                        'serviceperson-enlisted-date-month',
                        'serviceperson-enlisted-date-year',
                        'serviceperson-discharged-date-day',
                        'serviceperson-discharged-date-month',
                        'serviceperson-discharged-date-year',
                    ]
                ],
                'EMAIL_TEMPLATE' =>'101ce364-49e9-443c-8e4a-befc369fbcd5',
                'EMAIL_ADDRESS' => env('LAND_EMAIL', self::FALLBACK_EMAIL)
            ],
        ];
    }

    /**
     * @return ServiceBranch
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ServiceBranch;
        }

        return self::$instance;
    }

    /**
     * @param $branch
     * @return string
     */
    public function getName($branch)
    {
        if (isset($this->branches[$branch])) {
            return $this->branches[$branch]['NAME'] ?? '';
        } else {
            return 'Branch not found for: "' . $branch . '"';
        }
    }

    /**
     * @param $branch
     * @return mixed|string
     */
    public function getEmailTemplateId($branch)
    {
        if (isset($this->branches[$branch])) {
            return $this->branches[$branch]['EMAIL_TEMPLATE'] ?? '';
        } else {
            return 'Branch not found for: "' . $branch . '"';
        }
    }

    /**
     * @param $branch
     * @return mixed|string
     */
    public function getEmailAddress($branch)
    {
        if (isset($this->branches[$branch])) {
            return $this->branches[$branch]['EMAIL_ADDRESS'] ?? self::FALLBACK_EMAIL;
        } else {
            return self::FALLBACK_EMAIL;
        }
    }

    /**
     * Get a branch code for creating an application reference
     * @param $branch
     * @return mixed|string
     */
    public function getCode($branch) {
        if (isset($this->branches[$branch])) {
            return $this->branches[$branch]['CODE'] ?? '';
        } else {
            return 'Branch not found for: "' . $branch . '"';
        }
    }

    /**
     * @param $branch
     * @return mixed|string
     */
    public function getServiceBranch($branch) {
        if (isset($this->branches[$branch])) {
            return $this->branches[$branch]['SERVICE_BRANCH'] ?? '';
        } else {
            return 'Branch not found for: "' . $branch . '"';
        }
    }

    /**
     * @return array|string[]
     */
    public function getList()
    {
        $branchList = [];
        foreach ($this->branches as $branchKey => $branchValue) {
            $branchList[$branchKey] = $branchValue['NAME'];
        }

        return $branchList;
    }

    /**
     * @return array|string[]
     */
    public function getOptionList()
    {
        $optionsList = [];
        foreach ($this->branches as $branchKey => $branchValue) {
            $optionsList[$branchKey] = [
                'label' => $branchValue['NAME'],
                'value' => $branchValue['VALUE'],
                'children' => []
            ];
        }

        return $optionsList;
    }

    /**
     * @param $branch
     * @param $diedInService
     * @return array|mixed
     */
    public function getFields($branch = null, $diedInService = false)
    {
        if ($branch) {
            return $this->branches[$branch]['FIELDS'][($diedInService) ? 'DIS' : 'SIS'] ?? [];
        }

        $fieldset = [];
        foreach ($this->branches as $branch) {
            foreach ($branch['FIELDS'] as $fields) {
                foreach ($fields as $field) {
                    array_push($fieldset, $field);
                }
            }
        }

        return array_unique($fieldset);
    }
}
