@extends('layouts.app', ['title' => 'Service will be available at a later date - '])

@section('pageTitle', __('This service will be available at a later date'))
@section('content')
    <p class="govuk-body">Try again later.</p>
    <p class="govuk-body">You can make a paper based application here: <a
            href="https://www.gov.uk/get-copy-military-service-records">https://www.gov.uk/get-copy-military-service-records</a>
    </p>
    <p class="govuk-body">
        Use <a href="mailto:DBS-CIORAHSRFeedback@mod.gov.uk">DBS-CIO RAHSRFeedback@mod.gov.uk</a> if you need to contact
        the service
    </p>
@endsection
