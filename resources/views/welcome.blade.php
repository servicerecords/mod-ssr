@extends('layouts.app')

@section('title', 'Request an historic service record')

@section('content')

    <p class="govuk-body-l">Use this service to get information on a serviceperson who served in the armed forces.</p>

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
            <h2 class="govuk-heading-s">Death Certificates</h2>
            <p class="govuk-body">Get a copy of the death certificate before you start unless:</p>
            <ul class="govuk-list govuk-list--bullet">
                <li>the subject died in service</li>
                <li>was born more than 116 years ago</li>
            </ul>

            <h3 class="govuk-heading-s">Charges</h3>
            <p class="govuk-body">£30 charge for each record unless the subject is your:</p>
            <ul class="govuk-list govuk-list--bullet">
                <li>spouse</li>
                <li>civil partner</li>
                <li>child</li>
            </ul>

            <h3 class="govuk-heading-s"> Sending of Records</h3>
            <p class="govuk-body">Records will be sent to you by post.</p>

            <div class="govuk-inset-text">You will need a debit or credit card to use this service.</div>

            <h3 class="govuk-heading-s">Power of Attorney</h3>
            <p class="govuk-body">If you hold POA for the immediate next of kin, please see other ways to apply.</p>

        </section>
        <section class="govuk-tabs__panel govuk-tabs__panel--hidden" id="other-ways" role="tabpanel" aria-labelledby="tab_other-ways">
            <h2 class="govuk-heading-l">Other way to apply</h2>

            <p class="govuk-body">You can also <a href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#how-to-apply" class="govuk-link">request records by post</a>.</p>


        </section>
    </div>


{{--    <h2 class="govuk-heading-m">Other Information</h2>--}}

{{--    <p class="govuk-body">You can also <a href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#how-to-apply" class="govuk-link">request records by post</a>.</p>--}}

@endsection
