@extends('layouts.app')

@section('title', 'Request an historic service record')

@section('content')

    <p class="govuk-body-l">Use this service to obtain information relating to a serviceman/servicewoman who has served
    in the Royal Navy, Royal Marines, Army, Royal Air Force or Home Guard.</p>

    <h2 class="govuk-heading-m">Before you start</h2>

    <ul class="govuk-list govuk-list--bullet">
        <li>A death certificate may be required in some cases (<a class="govuk-link" href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel">see
                notes</a>)</li>
        <li>An administrative fee may apply (<a class="govuk-link" href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#administration-fee">see
                notes</a>)</li>
    </ul>

    <a href="/service" role="button" draggable="false" class="govuk-button govuk-button--start">
        Start now
    </a>

    <h2 class="govuk-heading-m">Other Information</h2>

    <p class="govuk-body">You can also <a href="https://www.gov.uk/guidance/request-records-of-deceased-service-personnel#how-to-apply" class="govuk-link">request records by post</a>.</p>

@endsection
