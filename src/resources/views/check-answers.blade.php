@extends('layouts.app')

@section('pageTitle', 'Check your answers before sending your application')

@section('content')
    <h2 class="govuk-heading-m">Serviceperson</h2>
    <x-summary-list :rows="$servicepersonFields"></x-summary-list>

    <h2 class="govuk-heading-m">Your Details</h2>
    <x-summary-list :rows="$applicantFields"></x-summary-list>

    <h2 class="govuk-heading-m">Submit your request</h2>

    @if(\App\Models\Application::getInstance()->paymentRequired)

    @else

    @endif

    By submitting your request you are confirming that the details are correct.
    A payment of £30 is required.
    The payment is not refundable even if a record is not found.
@endsection
