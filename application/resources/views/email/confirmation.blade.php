@extends('layouts.email')

@section('title', 'Your application has been sent')

@section('content')
    <ul class="govuk-list govuk-list--bullet govuk-!-margin-top-0">
        <li>Your application has been sent to the {{ $dbs_branch ?? 'DBS Branch' }}</li>
        <li>Your reference for this search is {{ $reference_number ?? 'REF-NO' }}</li>
    </ul>

    <h2 class="govuk-heading-m">What happens next</h2>
    <p class="govuk-body">
        The disclosure branch will perform the search based on the data you have given.
        The search for the record is a manual process and may take several months to complete.
    </p>
    <p class="govuk-body">You may be contacted for further information, using the contact details you provided.</p>
    <p class="govuk-body">If located, a copy of the paper record will be sent to you by post.</p>

    <h3 class="govuk-heading-s">How to get in touch</h3>
    <p class="govuk-body">To follow up on your request contact:</p>
    <p class="govuk-body">
        <a href="#">Multiuser Disclosure Branch e-mail link</a>
        (please provide your reference number and post code or zip code on contact)</p>

    <p class="govuk-body">
        <a href="{{ $service_url }}}/feedback" class="govuk-link">What did you think of this service?</a> (takes 30 seconds)
    </p>
@endsection
