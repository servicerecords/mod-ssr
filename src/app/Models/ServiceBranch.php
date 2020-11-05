<?php


namespace App\Models;


class ServiceBranch
{
    private static $instance = null;

    private const FALLBACK_EMAIL = 'lauren.phillips225@mod.gov.uk';

    public const NAVY = 'NAVY';
    public const RAF = 'RAF';
    public const ARMY = 'ARMY';
    public const HOME_GUARD = 'HOME_GUARD';

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
                'VALUE' => self::NAVY,
                'CODE' => 'SEA',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted',
                        'serviceperson-discharged',
                        'serviceperson-discharged-information'
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted',
                        'serviceperson-discharged',
                        'serviceperson-discharged-information',
                    ]
                ],
                'EMAIL_TEMPLATE' => [
                    'SIS' => 'df015c4f-0f1b-4559-9f2d-c37624590c8d',
                    'DIS' => 'edd45189-db4c-4b20-a5c8-a7490a4439e8'
                ],
                'EMAIL_ADDRESS' => env('SEA_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::ARMY => [
                'NAME' => 'Army (including Territorial & Army Emergency Reserve)',
                'VALUE' => self::ARMY,
                'CODE' => 'LAN',
                'FIELDS' => [
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged',
                        'serviceperson-regiment',
                    ],
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged',
                        'serviceperson-regiment',
                        'serviceperson-reason-for-leaving',
                        'serviceperson-additional-service',
                        'serviceperson-additional-service-ta-number',
                        'serviceperson-additional-service-ta-regiment',
                        'serviceperson-additional-service-ta-date',
                        'serviceperson-additional-service-aer-number',
                        'serviceperson-additional-service-aer-regiment',
                        'serviceperson-additional-service-aer-date',
                        'serviceperson-disability-pension',
                        'serviceperson-additional-information'
                    ]
                ],
                'EMAIL_TEMPLATE' => '68640434-bc34-4c0c-b8d4-de6d734661c6',
//                 [

//                    'SIS' => 'c811ac5c-cd6f-4702-8db5-ff105e364277',
//                    'DIS' => '5f3a549b-9019-4c7f-8995-fb47ae4905bd'
//                ],
                'EMAIL_ADDRESS' => env('LAND_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::RAF => [
                'NAME' => 'Royal Air Force (RAF)',
                'VALUE' => self::RAF,
                'CODE' => 'AIR',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted',
                        'serviceperson-discharged',
                        'serviceperson-discharged-information'
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-enlisted',
                        'serviceperson-discharged',
                        'serviceperson-discharged-information'
                    ]
                ],
                'EMAIL_TEMPLATE' => [
                    'SIS' => '9f2603ce-2bd0-4bc4-868b-72a3c066b10a',
                    'DIS' => 'debb071c-90be-4254-898f-31ab28c58f3d'
                ],
                'EMAIL_ADDRESS' => env('AIR_EMAIL', self::FALLBACK_EMAIL)
            ],
            self::HOME_GUARD => [
                'NAME' => 'Home Guard',
                'VALUE' => self::HOME_GUARD,
                'CODE' => 'LAN',
                'FIELDS' => [
                    'SIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged',
                        'serviceperson-county-served',
                        'serviceperson-address-when-joined',
                        'serviceperson-battalions',
                    ],
                    'DIS' => [
                        'serviceperson-service-number',
                        'serviceperson-discharged',
                        'serviceperson-county-served',
                        'serviceperson-address-when-joined',
                        'serviceperson-battalions',
                    ]
                ],
                'EMAIL_TEMPLATE' => [
                    'SIS' => 'f61949e7-4a5e-4d2d-8264-bbbf5e25ddfc',
                    'DIS' => 'a4cae06b-1ac7-4f9e-97ea-1b6f47e147c9'
                ],
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
    public function getEmailTemplate($branch)
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
            return $this->branches[$branch]['EMAIL_ADDRESS'] ?? '';
        } else {
            return self::FALLBACK_EMAIL;
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
