@extends('layouts.app')

@section('pageTitle', 'Your details')

@section('content')
    <form method="post" action="{{ route('applicant-details.save') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-textfield label="Your full name"
                     field="applicant-name"
                     autocomplete="name"
                     :spellcheck="false"></x-textfield>
        <x-textfield label="Email address"
                     field="applicant-email-address"></x-textfield>
        <x-textfield label="Building and street"
                     extra="line 1 of 2"
                     field="applicant-address-line-1"
                     autocomplete="address-line1"
                     :full-width="true"></x-textfield>
        <x-textfield label="Building and street line 2 of 2"
                     field="applicant-address-line-2"
                     autocomplete="address-line2"
                     :full-width="true"
                     :hideLabel="true"></x-textfield>
        <x-textfield label="Town"
                     autocomplete="address-level2"
                     field="applicant-address-town"></x-textfield>
        <x-textfield label="Postcode"
                     autocomplete="postal-code"
                     field="applicant-address-postcode"></x-textfield>
        <x-country label="Country"
                   field="applicant-address-country"></x-country>
        <x-textfield label="Telephone Number"
                     autocomplete="tel"
                     field="applicant-telephone"
                     type="tel"
                     autocomplete="tel"
                     hint="For international numbers include the country code."></x-textfield>
        <x-radio-group label="Use these details for billing?"
                       field="applicant-details-transfer"
                       :options="$options"></x-radio-group>
        <x-submit-form></x-submit-form>
    </form>
@endsection
