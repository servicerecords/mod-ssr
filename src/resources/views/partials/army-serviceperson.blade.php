<x-date-field
    :label="session('serviceperson-died-in-service', \App\Models\Constant::NO) === \App\Models\Constant::NO ? 'Year of discharge' : 'Year of death in service'"
    field="serviceperson-discharged-date" hint="Approximate if you are unsure."
    :hide-day="true" :hide-month="true" :hide-year-label="true" :mandatory="false"></x-date-field>

<x-textfield label="Regt/Corps" field="serviceperson-regiment"
             :hint="session('serviceperson-died-in-service', \App\Models\Constant::NO) === \App\Models\Constant::NO ? 'At time of discharge' : 'At time of death'"
             :mandatory="false"></x-textfield>

@if(session('serviceperson-died-in-service', App\Models\Constant::YES) === App\Models\Constant::NO)
    <x-radio-group label="Why did they leave the Army?"
                   field="serviceperson-reason-for-leaving"
                   :mandatory="false"
                   :options="[
                       [ 'label' => 'Normal demobilisation after WW2', 'children' => [] ],
                       [ 'label' => 'Completion of regular engagement', 'children' => [] ],
                       [ 'label' => 'Medical discharge', 'children' => [] ],
                       [ 'label' => 'End of National Service', 'children' => [] ],
                       [ 'label' => 'Other', 'children' => [] ],
                   ]"></x-radio-group>

    <x-checkbox-group label="Did they serve with either of the following?"
                      field="serviceperson-additional-service"
                      :mandatory="false"
                      :options="[
                        [
                          'label'    => 'Territorial Army (TA)',
                          'field'    => '-ta',
                          'children' => [
                            [ 'label' => 'Number', 'field' => 'number' ],
                            [ 'label' => 'Regt/Corps', 'field' => 'regiment' ],
                            [ 'label' => 'Dates', 'field' => 'dates'],
                          ]
                        ],
                        [
                          'label'    => 'Army Emergency Reserve (AER)',
                          'field'    => '-aer',
                          'children' => [
                            [ 'label' => 'Number', 'field' => 'number' ],
                            [ 'label' => 'Regt/Corps', 'field' => 'regiment' ],
                            [ 'label' => 'Dates', 'field' => 'dates'],
                          ]
                        ]
                      ]"></x-checkbox-group>

    <x-radio-group label="Has a Disability Pension been applied for?"
                   field="serviceperson-disability-pension"
                   :mandatory="false"
                   :options="[
                               [ 'label' => App\Models\Constant::YES, 'value' => App\Models\Constant::YES, 'children' => [] ],
                               [ 'label' => App\Models\Constant::NO,  'value' => App\Models\Constant::NO, 'children' => [] ],
                               [ 'label' => App\Models\Constant::UNKNOWN, 'value' => App\Models\Constant::UNKNOWN, 'children' => [] ],
                    ]"></x-radio-group>

    <x-text-area label="Further information"
                 field="serviceperson-additional-information"
                 hint="For example Ranks, Grades, Regiments, National Insurance number."
                 :mandatory="false" :character-limit="200"></x-text-area>
@endif
