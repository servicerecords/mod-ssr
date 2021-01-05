@extends('layouts.app', ['title' => 'Sorry, there is a problem with the service - '])

@section('pageTitle', __('Sorry, there is a problem with the service'))
@section('content')
    <p class="govuk-body">Try again later.</p>
    <p class="govuk-body">We have not saved your answers. You can restart your application from the
        <a class="/" href="#">service homepage</a>.
    </p>
    <p class="govuk-body">You can make a paper based application here:
        <a href="https://www.gov.uk/get-copy-military-service-records">
            https://www.gov.uk/get-copy-military-service-records
        </a>
    </p>
    <p class="govuk-body">
        Use <a href="mailto:{{ env('FEEDBACK_EMAIL', 'DBS-CIORAHSRFeedback@mod.gov.uk') }}">
            {{ env('FEEDBACK_EMAIL', 'DBS-CIORAHSRFeedback@mod.gov.uk') }}
        </a> if you need to contact the service
    </p>
@endsection
