<h2 class="govuk-heading-m">Serviceperson</h2>
<dl class="govuk-summary-list govuk-!-margin-bottom-9">
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Service
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('service') }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/service">
                Change<span class="govuk-visually-hidden"> service</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            @if(Session::get('service') == 'Home Guard')
                National Registration Number
            @else
                Official Service Number
            @endif
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('service_details')['service_number'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/service-details">
                Change<span class="govuk-visually-hidden"> service</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Died in service
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('death_in_service')['death'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/service/death-in-service">
                Change<span class="govuk-visually-hidden"> death in service</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            First names
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('essential_information')['firstnames'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/essential-information">
                Change<span class="govuk-visually-hidden"> first names</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Last name
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('essential_information')['lastname'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/essential-information">
                Change<span class="govuk-visually-hidden"> last name</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Date of birth
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('essential_information')['dob'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/essential-information">
                Change<span class="govuk-visually-hidden"> date of birth</span>
            </a>
        </dd>
    </div>
    @if(Session::get('service') == 'Royal Navy / Royal Marines')
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Date joined
            </dt>
            <dd class="govuk-summary-list__value">
                {{ Session::get('service_details')['join_date'] }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change<span class="govuk-visually-hidden"> date joined</span>
                </a>
            </dd>
        </div>
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                @if(Session::get('death_in_service')['death'] != 'Yes')
                    Date of discharge
                @else
                    Date of death
                @endif
            </dt>
            <dd class="govuk-summary-list__value">
                {{ Session::get('service_details')['discharge_date'] }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change<span class="govuk-visually-hidden"> date discharged</span>
                </a>
            </dd>
        </div>
    @endif

    @if(Session::get('service') == 'Royal Air Force (RAF)')
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Date joined
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('service_details')['join_date'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/service-details">
                Change<span class="govuk-visually-hidden"> date joined</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            @if(Session::get('death_in_service')['death'] != 'Yes')
            Date of discharge
            @else
            Date of casualty / aircraft loss
            @endif
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('service_details')['discharge_date'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/service-details">
                Change
            </a>
        </dd>
    </div>
    @endif

    @if(Session::get('service') == 'Army')
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                @if(Session::get('death_in_service')['death'] == 'Yes')
                Year of death
                @else
                Year of discharge
                @endif
            </dt>
            <dd class="govuk-summary-list__value">
                {{ Session::get('service_details')['discharge_year'] }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change
                </a>
            </dd>
        </div>

        @if(Session::get('death_in_service')['death'] != 'Yes')
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Reason for leaving
                </dt>
                <dd class="govuk-summary-list__value">
                    @if(isset(Session::get('service_details')['leave_army_reason']))
                        <p class="govuk-body">{{ Session::get('service_details')['leave_army_reason'] }}</p>
                    @endif
                </dd>
                <dd class="govuk-summary-list__actions">
                    <a class="govuk-link" href="/service-details">
                        Change
                    </a>
                </dd>
            </div>
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Futher service after army
                </dt>
                <dd class="govuk-summary-list__value">
                    @if(isset(Session::get('service_details')['completion_info']))
                        <p class="govuk-body">{{Session::get('service_details')['completion_info']}}</p>
                    @endif
                </dd>
                <dd class="govuk-summary-list__actions">
                    <a class="govuk-link" href="/service-details">
                        Change
                    </a>
                </dd>
            </div>
            @if(isset(Session::get('service_details')['completion_info']))
                @if(in_array('Territorial Army (TA)', Session::get('service_details')['completion_info']))
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Territorial Army Number
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['ta_army_number']) ? Session::get('service_details')['ta_army_number'] : '-') }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Regt/Corps
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['army_regt_corps']) ? Session::get('service_details')['army_regt_corps'] : '-') }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Dates
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['ta_army_dates']) ? Session::get('service_details')['ta_army_dates'] : '-') }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                    @endif

                    @if(in_array('Army Emergency Reserve (AER)', Session::get('service_details')['completion_info']))
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Army Emergency Reserve Number
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['aer_number']) ? Session::get('service_details')['aer_number'] : '-') }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Regt/Corps
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['aer_regt_corps']) ? Session::get('service_details')['aer_regt_corps'] : '') }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                        <div class="govuk-summary-list__row">
                            <dt class="govuk-summary-list__key">
                                Dates
                            </dt>
                            <dd class="govuk-summary-list__value">
                                {{ (isset(Session::get('service_details')['aer_dates']) ? Session::get('service_details')['aer_dates'] : '-' ) }}
                            </dd>
                            <dd class="govuk-summary-list__actions">
                                <a class="govuk-link" href="/service-details">
                                    Change
                                </a>
                            </dd>
                        </div>
                    @endif
                @endif
        @endif
    @endif

    @if(Session::get('service') == 'Home Guard')
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Which county did they serve in
            </dt>
            <dd class="govuk-summary-list__value">
                {{ Session::get('service_details')['county'] }}
                {{ (isset(Session::get('service_details')['county'])) ? Session::get('service_details')['county'] : '' }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change
                </a>
            </dd>
        </div>
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Address at enlistment
            </dt>
            <dd class="govuk-summary-list__value">
                {{ (isset(Session::get('service_details')['address_at_entlistment'])) ? Session::get('service_details')['address_at_entlistment'] : '' }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change
                </a>
            </dd>
        </div>
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Address at discharge
            </dt>
            <dd class="govuk-summary-list__value">
                {{ (isset(Session::get('service_details')['address_at_discharge'])) ? Session::get('service_details')['address_at_discharge'] : '' }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change
                </a>
            </dd>
        </div>
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Battalions/Companies
            </dt>
            <dd class="govuk-summary-list__value">
                {{ (isset(Session::get('service_details')['battalions_companies'])) ? Session::get('service_details')['battalions_companies'] : '' }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/service-details">
                    Change
                </a>
            </dd>
        </div>
    @endif
</dl>
