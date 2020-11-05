<?php

namespace App\Models;


class Constant
{
    public const YES                                = 'Yes';
    public const NO                                 = 'No';
    public const UNKNOWN                            = 'Don\'t know';
    public const DATE_PLACEHOLDER                   = '—';

    public const DAY_PLACEHOLDER                    = self::DATE_PLACEHOLDER . self::DATE_PLACEHOLDER;
    public const MONTH_PLACEHOLDER                  = self::DAY_PLACEHOLDER;
    public const YEAR_PLACEHOLDER                   = self::DAY_PLACEHOLDER . self::DAY_PLACEHOLDER;

    public const RELATION_UNRELATED                 = 'I am not related';
    public const RELATION_SPOUSE                    = 'I am their spouse/civil partner';
    public const RELATION_CHILD                     = 'I am their son/daughter';
    public const RELATION_GRANDCHILD                = 'I am their grandchild';
    public const RELATION_PARENT                    = 'I am their mother/father';
    public const RELATION_SIBLING                   = 'I am their brother/sister';
    public const RELATION_NIECE_NEPHEW              = 'I am their niece/nephew';
    public const RELATION_GRANDPARENT               = 'I am their grandparent';
    public const RELATION_OTHER                     = 'Other';

    public const SELECTED_SERVICE                   = 1;
    public const SELECTED_DIED_IN_SERVICE           = 2;
    public const SELECTED_ESSENTIAL_INFO            = 4;
    public const SELECTED_SERVICEPERSON_DETAILS     = 8;
    public const SELECTED_DEATH_CERTIFICATE         = 16;
    public const SELECTED_APPLICANT_DETAILS         = 32;
    public const SELECTED_APPLICANT_RELATIONSHIP    = 64;
    public const SELECTED_APPLICANT_NEXT_OF_KIN     = 128;


}
