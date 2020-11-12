<x-date-field label="Date they joined"
              field="serviceperson-enlisted-date"
              hint="Partial dates are accepted."
              :mandatory="false"></x-date-field>
<x-date-field
    :label="session('serviceperson-died-in-service', \App\Models\Constant::NO) === \App\Models\Constant::NO ? 'Date they left' : 'Date of casualty / aircraft loss'"
    field="serviceperson-discharged-date"
    :hint="session('serviceperson-died-in-service', \App\Models\Constant::NO) === \App\Models\Constant::NO ? 'Partial dates are accepted.' : 'Provide as much as you know. Partial dates are accepted.'"
    :mandatory="false"></x-date-field>
<x-text-area label="Further information"
             field="serviceperson-discharged-information"
             hint="For example Ranks, Grades, Regiments, National Insurance number."
             :mandatory="false"
             :character-limit="200"></x-text-area>
