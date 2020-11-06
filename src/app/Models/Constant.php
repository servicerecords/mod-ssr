<?php

namespace App\Models;


class Constant
{
    public const YES = 'Yes';
    public const NO = 'No';
    public const UNKNOWN = 'Don\'t know';
    public const DATE_PLACEHOLDER = '—';

    public const DAY_PLACEHOLDER = 'DD';
    public const MONTH_PLACEHOLDER = 'MM';
    public const YEAR_PLACEHOLDER = 'YYYY';

    public const RELATION_UNRELATED = 'I am not related';
    public const RELATION_SPOUSE = 'I am their spouse/civil partner';
    public const RELATION_CHILD = 'I am their son/daughter';
    public const RELATION_GRANDCHILD = 'I am their grandchild';
    public const RELATION_PARENT = 'I am their mother/father';
    public const RELATION_SIBLING = 'I am their brother/sister';
    public const RELATION_NIECE_NEPHEW = 'I am their niece/nephew';
    public const RELATION_GRANDPARENT = 'I am their grandparent';
    public const RELATION_OTHER = 'Other';

    public const SECTION_SERVICE = 1;
    public const SECTION_DIED_IN_SERVICE = 2;
    public const SECTION_ESSENTIAL_INFO = 4;
    public const SECTION_SERVICEPERSON_DETAILS = 8;
    public const SECTION_DEATH_CERTIFICATE = 16;
    public const SECTION_APPLICANT_DETAILS = 32;
    public const SECTION_APPLICANT_RELATIONSHIP = 64;
    public const SECTION_APPLICANT_NEXT_OF_KIN = 128;

    public const SERVICEPERSION = 'serviceperson';
    public const APPLICANT = 'applicant';
}
