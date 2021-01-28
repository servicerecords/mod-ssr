@extends('layouts.app', ['title' => 'Accessibility statement - '])

@section('pageTitle', 'Accessibility statement for ' . env('APP_NAME', 'Apply for a deceased\'s military record'))

@section('content')
    <p class="govuk-body">This website is run by the Ministry of Defence. We want as many people as possible to be able
        to use this website. For example, that means you should be able to:</p>

    <ul class="govuk-list govuk-list--bullet">
        <li>change colours, contrast levels and fonts</li>
        <li>zoom in up to 300% without the text spilling off the screen</li>
        <li>navigate most of the website using just a keyboard</li>
        <li>navigate most of the website using speech recognition software</li>
        <li>listen to most of the website using a screen reader (including the most recent versions of JAWS, NVDA and
            VoiceOver)
        </li>
    </ul>

    <p class="govuk-body">
        We've also made the website text as simple as possible to understand.
    </p>
    <p class="govuk-body">AbilityNet has advice on making your device easier to use if you have a disability.</p>

    <h2 class="govuk-heading-m">How accessible this website is</h2>
    <p class="govuk-body">We know some parts of this website are not fully accessible</p>

    <h2 class="govuk-heading-m">Feedback and contact information</h2>
    <p class="govuk-body">If you have accessibility feedback on this website, please use the feedback page at the end of the application.</p>
    <p class="govuk-body">We’ll consider your request and get back to you in 7 days.</p>

    <h2 class="govuk-heading-m">Reporting accessibility problems with this website</h2>
    <p class="govuk-body">We’re always looking to improve the accessibility of this website. If you find any problems
        not listed on this page or think we’re not meeting accessibility requirements, contact us through our feedback page.</p>

    <h2 class="govuk-heading-m">Enforcement procedure</h2>
    <p class="govuk-body">The Equality and Human Rights Commission (EHRC) is responsible for enforcing the Public Sector
        Bodies (Websites and Mobile Applications) (No. 2) Accessibility Regulations 2018 (the 'accessibility regulations').
        If you’re not happy with how we respond to your complaint,
        <a href="https://www.equalityadvisoryservice.com/">contact the Equality Advisory and Support Service (EASS)</a>.</p>

    <h2 class="govuk-heading-m">Technical information about this website’s accessibility</h2>
    <p class="govuk-body">The Ministry of Defence is committed to making its website accessible, in accordance with the
        Public Sector Bodies (Websites and Mobile Applications) (No. 2) Accessibility Regulations 2018.</p>

    <h2 class="govuk-heading-m">Compliance status</h2>
    <p class="govuk-body">This website is fully compliant with the
        <a href="https://www.w3.org/TR/WCAG21/">Web Content Accessibility Guidelines version 2.1</a> AA standard.</p>

    <h2 class="govuk-heading-m">Content that’s not within the scope of the accessibility regulations</h2>
    <p class="govuk-body">Our accessibility roadmap shows how and when we plan to improve accessibility on this website.</p>

    <h2 class="govuk-heading-m">Preparation of this accessibility statement</h2>
    <p class="govuk-body">This statement was prepared on 16th December 2020. It was last reviewed on 15th January 2021.</p>
    <p class="govuk-body">This website was last tested w/c 11th January 2021. The test was carried out by Digital Accessibility Centre.</p>
    <p class="govuk-body">We tested the entire service.</p>
    <p class="govuk-body">You can read the full accessibility test report on request from the disclosure branch.</p>
@endsection
