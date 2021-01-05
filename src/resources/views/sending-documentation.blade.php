@extends('layouts.app', ['title' => 'Sending Documentation Death Certificate Upload - ']))
@section('pageTitle', 'Sending documentation')

@section('content')
    <h2 class="govuk-heading-m">
        Death certificate required
    </h2>
    <p class="govuk-body">
        Upload your death certificate in .jpg, .png or .pdf formats.
        PDF files must have the death certificate on the first page.
        Ensure image is clear and shows all of the death certificate.
    </p>

    <form method="post" action="{{ route('sending-documentation.save') }}" enctype="multipart/form-data" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-file-upload label="Upload your death certificate"
                       field="death-certificate"
                       accept=".jpg,.jpeg,.png,.bmp,.pdf"></x-file-upload>
        <x-submit-form></x-submit-form>
    </form>
@endsection
