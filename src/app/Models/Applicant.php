<?php


namespace App\Models;


use Illuminate\Support\Str;

class Applicant
{
    private static $instance = null;
    private $formFields = [
        ['label' => '', 'field' => 'applicant-name', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-email-address', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-address-line-1', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-address-line-2', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-address-town', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-address-postcode', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-address-country', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-telephone', 'mandatory' => true],
        ['label' => '', 'field' => 'applicant-details-transfer', 'mandatory' => true],
    ];

    /**
     * Application constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Applicant|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Applicant();
        }

        return self::$instance;
    }


}
