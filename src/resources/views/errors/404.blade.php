@extends('layouts.app', ['title' => 'Page not found - '])

@section('pageTitle', __('Page not found'))


@section('content')
    <p class="govuk-body">
        If you typed the web address, check it is correct.
    </p>
    <p class="govuk-body">
        If you pasted the web address, check you copied the entire address.
    </p>
    <p class="govuk-body">
        If the web address is correct or you selected a link or button,
        <a href="mailto:DBS-CIORAHSRFeedback@mod.gov.uk">contact DBS-CIO RAHSRFeedback@mod.gov.uk</a> if you need to
        speak to someone about your Service Record application.
    </p>
@endsection
