@extends('layouts.app', ['title' => 'Application complete - '])
@section('pageTitle', false)

@section('content')
    <x-confirmation-panel></x-confirmation-panel>

    <p class="govuk-body">We have sent you a confirmation email.</p>
    <h2 class="govuk-heading-m">What happens next</h2>
    <p class="govuk-body">We've sent your application to the military disclosure branch.</p>
    <p class="govuk-body">The confirmation email we sent contains your:</p>
    <div class="govuk-form-group">
        <ul class="govuk-list govuk-list--bullet">
            <li>reference number</li>
            <li>contact details for the military disclosure branch</li>
            <li>information about what happens now</li>
        </ul>
    </div>

    <p class="govuk-body">The military disclosure branch will contact you to confirm that they have your request.</p>
    <p class="govuk-body">
        <a href="{{ route('feedback') }}" class="govuk-link">What did you think of this service?</a> (takes 30 seconds)
    </p>
@endsection
