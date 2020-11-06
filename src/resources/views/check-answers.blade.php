@extends('layouts.app')

@section('pageTitle', 'Check your answers before sending your application')

@section('content')
    <h2 class="govuk-heading-m">Serviceperson</h2>
    <x-summary-list :rows="$serviceperson"></x-summary-list>

    <h2 class="govuk-heading-m">Your Details</h2>
    <x-summary-list :rows="$applicant"></x-summary-list>

    <h2 class="govuk-heading-m">Submit your request</h2>

    By submitting your request you are confirming that the details are correct.
    A payment of £30 is required.
    The payment is not refundable even if a record is not found.

    <form method="post" action="{{ route('check-answers.save') }}" novalidate>
            <x-submit-form
                :submit-label="\App\Models\Application::getInstance()->isFree() ? 'Accept and Send' : 'Accept and Pay'">
            </x-submit-form>
    </form>
@endsection
