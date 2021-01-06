@extends('layouts.app', ['title' => 'Privacy Policy - '])

@section('pageTitle', 'Privacy Policy')

@section('content')
    <p class="govuk-body">When you {{ Str::lower( env('APP_NAME', 'Apply for a deceased\'s military record' ) ) }} you
        will be asked for a range of information,
        including your name and contact details, the name of your subject, their date of birth, and further
        information to help identify their records.
    </p>

    <p class="govuk-body">
        Information you enter will be held temporarily and securely in line with our <a
            href="{{ route('cookie-policy') }}">cookie policy</a>.
        We do this so you can progress through and complete your application. At the end of the process this information
        will be used to create an email request to the MOD Disclosure Branch. The cookies holding your information,
        and any uploaded documents, will be removed from your computer at the end of the process.
    </p>

    <p class="govuk-body">
        If you don't complete the process to submit your application, this information may be retained in files on your
        computer. You can clear this cookie data in the normal way, via browser settings or by searching for "clearing
        cookie data" for a method specific to your browser.
    </p>

    <p class="govuk-body">
        The personal data that you have provided in this form will be used only for the purposes of processing your
        request for information by the relevant branch of MOD; this form will be retained for a minimum of 2 years and
        then destroyed.
    </p>

    <p class="govuk-body">
        By signing this form you are confirming that you understand the above and that you agree that your personal data
        can be used as stated. We recommend that you read the <a
            href="https://www.gov.uk/government/organisations/ministry-of-defence/about/personal-information-charter">MOD's
            Personal Information Charter</a>
        and the <a
            href="https://www.gov.uk/government/publications/ministry-of-defence-privacy-notice">MOD's Privacy
            Notice</a> in full as they provide more detail on how we manage personal data.
    </p>
@endsection
