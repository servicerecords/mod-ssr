@extends('layouts.app', ['title' => 'Sending Documentation Death Certificate Upload - '])
@section('pageTitle', 'Sending documentation')

@section('content')
    <h2 class="govuk-heading-m">
        Death certificate required
    </h2>
    <p class="govuk-body">
        Upload the serviceperson’s death certificate in one of the listed formats.
    </p>

    <div class="govuk-details__text govuk-!-margin-bottom-4">
        <ul class="govuk-list govuk-list--bullet">
            <li>jpg</li>
            <li>png</li>
            <li>pdf</li>
        </ul>
    </div>


    <p class="govuk-body">
        PDF files must have the death certificate on the first page.
        Ensure image is clear and shows all of the death certificate.
    </p>

    <form method="post" action="{{ route('sending-documentation.save') }}" enctype="multipart/form-data" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-file-upload label="Upload the serviceperson's death certificate."
                       field="death-certificate"
                       accept=".jpg,.jpeg,.png,.pdf"></x-file-upload>
        <x-submit-form></x-submit-form>
    </form>
@endsection
