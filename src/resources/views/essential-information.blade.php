@extends('layouts.app', ['title' => 'Serviceperson\'s Details - '])
@section('pageTitle', 'Details of the serviceperson')

@section('content')
    <form method="post" action="{{ route('essential-information.save') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-textfield label="First name(s)"
                     hint="Include all middle names"
                     field="serviceperson-first-name"
                     autocomplete="given-name"
                     :spellcheck="false"></x-textfield>
        <x-textfield label="Last name"
                     field="serviceperson-last-name"
                     autocomplete="family-name"
                     :spellcheck="false"></x-textfield>
        <x-textfield label="Place of birth"
                     field="serviceperson-place-of-birth"
                     :mandatory="false"></x-textfield>
        <x-date-field label="Date of birth"
                      hint="For example, 31 3 1910. A year of birth is required."
                      field="serviceperson-date-of-birth-date"></x-date-field>
        <x-submit-form></x-submit-form>
    </form>
@endsection
