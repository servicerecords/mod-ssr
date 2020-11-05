@extends('layouts.app')

@section('pageTitle', 'Your details')

@section('content')
   <form method="post" action="{{ route('applicant-relationship.save') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-radio-group label="How are you related to the serviceperson?"
                       field="applicant-relationship"
                       hint="Related applicants may get access to more sensitive information about the serviceperson than non-related applicants."
                       :options="$relationships" :has-conditionals="true"></x-radio-group>

        <p class="govuk-body">You may be contacted to provide proof of your relationship with the service person.</p>
        <x-submit-form></x-submit-form>
    </form>
@endsection
