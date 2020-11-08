@extends('layouts.app')

@section('pageTitle', 'Check your answers before sending your application')

@section('content')
    <h2 class="govuk-heading-m">Serviceperson</h2>
    <x-summary-list :rows="$serviceperson"></x-summary-list>

    <h2 class="govuk-heading-m">Your Details</h2>
    <x-summary-list :rows="$applicant"></x-summary-list>

    <h2 class="govuk-heading-m">Submit your request</h2>

    @if(\App\Models\Application::getInstance()->isFree())
        <p class="govuk-body">By submitting this request you are confirming that the details are correct.</p>
    @else
        <ul class="govuk-list govuk-list--bullet">
            <li>By submitting your request you are confirming that the details are correct.</li>
            <li>A payment of £30 is required.</li>
            <li>The payment is not refundable even if a record is not found.</li>
        </ul>
    @endif

    <form method="post" action="{{ route('check-answers.save') }}" novalidate>
            <x-submit-form
                :submit-label="\App\Models\Application::getInstance()->isFree() ? 'Accept and Send' : 'Accept and Pay'">
            </x-submit-form>
    </form>
@endsection
