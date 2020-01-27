@extends('layouts.app')

@section('title', 'Request an historic service record')

@section('content')

    <p class="govuk-body-l">Use this service to obtain information relating to a serviceman/servicewoman who has served
    in the Royal Navy, Royal Marines, Army, Royal Air Force or Home Guard.</p>

    <a href="/service" role="button" draggable="false" class="govuk-button govuk-button--start">
        Start now
    </a>

    <div class="govuk-tabs" data-module="tabs">
        <h2 class="govuk-tabs__title">
            Contents
        </h2>
        <ul class="govuk-tabs__list" role="tablist">
            <li class="govuk-tabs__list-item govuk-tabs__list-item--selected" role="presentation">
                <a class="govuk-tabs__tab" href="#information" id="tab_information" role="tab" aria-controls="information" aria-selected="true" tabindex="0">
                    More information
                </a>
            </li>
            <li class="govuk-tabs__list-item" role="presentation">
                <a class="govuk-tabs__tab" href="#other-ways" id="tab_other-ways" role="tab" aria-controls="other-ways" aria-selected="false" tabindex="-1">
                    Other ways to apply
                </a>
            </li>
        </ul>
        <section class="govuk-tabs__panel" id="information" role="tabpanel" aria-labelledby="tab_information">
            <h2 class="govuk-heading-l">More information</h2>
            <h3 class="govuk-heading-s">Death Certificates</h3>
            <p class="govuk-body">If the person whose record you are applying for was born less than 116 years ago, you will need to provide a copy of their death certificate.
                If the person was killed in service a death certificate is not required regardless of date of birth.
                If you do not have a copy of the death certificate, please get one before starting this process.</p>

            <h3 class="govuk-heading-s">Charges</h3>
            <p class="govuk-body">There is a £30 charge to request each record unless you are the spouse, civil partner or parent of the person whose record you are requesting.</p>
            <div class="govuk-inset-text">You will need a debit or credit card to use this service.</div>

            <h3 class="govuk-heading-s">Power of Attorney</h3>
            <p class="govuk-body">If you hold POA for the immediate next of kin, please apply by post.</p>

        </section>
        <section class="govuk-tabs__panel govuk-tabs__panel--hidden" id="other-ways" role="tabpanel" aria-labelledby="tab_other-ways">
            <h2 class="govuk-heading-l">Other way to apply</h2>

            <p class="govuk-body">You can also <a href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#how-to-apply" class="govuk-link">request records by post</a>.</p>


        </section>
    </div>


{{--    <h2 class="govuk-heading-m">Other Information</h2>--}}

{{--    <p class="govuk-body">You can also <a href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#how-to-apply" class="govuk-link">request records by post</a>.</p>--}}

@endsection
