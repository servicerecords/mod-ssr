<x-date-field label="Date they joined"
              field="serviceperson-enlisted-date"
              hint="Partial dates are accepted."
              :mandatory="false"></x-date-field>

<x-date-field
    :label="session('serviceperson-died-in-service', \App\Models\Constant::NO) === \App\Models\Constant::NO ? 'Date they left' : 'Date of death in service'"
    field="serviceperson-discharged-date"
    hint="Partial dates are accepted."
    :mandatory="false"></x-date-field>

<x-textfield label="Which county did they serve in?" field="serviceperson-county-served"
             :mandatory="false"></x-textfield>

<x-textfield label="Address when they joined" field="serviceperson-address-when-joined"
             :mandatory="false" autocomplete="street-address"></x-textfield>

<x-textfield label="Numbers of any Battalions and Companies" field="serviceperson-battalions"
             :mandatory="false"></x-textfield>
