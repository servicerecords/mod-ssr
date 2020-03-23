@extends('layouts.app')

@section('content')

    <div class="govuk-panel govuk-panel--confirmation">
        <h1 class="govuk-panel__title">
            Service record request complete
        </h1>
        <div class="govuk-panel__body">
            Your reference number<br><strong>{{ $reference }}</strong>
        </div>
    </div>

    <h2 class="govuk-heading-m">What happens next</h2>

    <p class="govuk-body">We have sent you a confirmation email.</p>
    <p class="govuk-body">
        We've sent your request to the {{ $dbs_team }} Branch.
    </p>

    <p class="govuk-body">
        <a href="/feedback" class="govuk-link">What did you think of this service?</a> (takes 30 seconds)
    </p>

@endsection
