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

    <p class="govuk-body">We know some parts of this website are not fully accessible:</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>you cannot modify the line height or spacing of text</li>
    </ul>

    <h2 class="govuk-heading-m">What to do if you cannot access parts of this website</h2>
    <p class="govuk-body">If you need information on this website in a different format like accessible PDF, large
        print,
        easy read, audio recording or braille:</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>email <a href="DBSCIO-RAHSRFeedback@mod.gov.uk">DBSCIO-RAHSRFeedback@mod.gov.uk</a></li>
    </ul>

    <p class="govuk-list govuk-list--bullet">
        We'll consider your request and get back to you in 5 days.
    </p>

    <h2 class="govuk-heading-m">Reporting accessibility problems with this website</h2>
    <p class="govuk-body">We're always looking to improve the accessibility of this website. If you find any problems
        not
        listed on this page or think we’re not meeting accessibility requirements, contact:</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>email <a href="DBSCIO-RAHSRFeedback@mod.gov.uk">DBSCIO-RAHSRFeedback@mod.gov.uk</a></li>
    </ul>

    <h2 class="govuk-heading-m">Enforcement procedure</h2>
    <p class="govuk-body">The Equality and Human Rights Commission (EHRC) is responsible for enforcing the Public Sector
        Bodies
        (Websites and Mobile Applications) (No. 2) Accessibility Regulations 2018 (the ‘accessibility regulations’). If
        you’re not happy with how we respond
        to your complaint, contact the <a href="https://www.equalityadvisoryservice.com/">Equality Advisory and Support
            Service (EASS)</a>.
        [Note: if your organisation is based in Northern Ireland, refer users who want to complain to the Equalities
        Commission for Northern Ireland (ECNI) instead
        of the EASS and EHRC.]</p>

    <h2 class="govuk-heading-m">Contacting us by phone or visiting us in person</h2>
    <p class="govuk-body">We provide a text relay service for people who are D/deaf, hearing impaired or have a speech
        impediment.</p>
    <p class="govuk-body">Our offices have audio induction loops, or if you contact us before your visit we can arrange
        a British Sign Language (BSL) interpreter.</p>

    <h2 class="govuk-heading-m">Technical information about this website's accessibility</h2>
    <p class="govuk-body">The Ministry of Defence is committed to making its website accessible,
        in accordance with the Public Sector Bodies (Websites and Mobile Applications) (No. 2) Accessibility Regulations
        2018.</p>
    <p class="govuk-list govuk-list--bullet">This website is partially compliant with the <a
            href="https://www.w3.org/TR/WCAG21/">Web Content
            Accessibility Guidelines</a> version 2.1 AA standard, due to the non-compliances listed below.</p>

    <h2 class="govuk-heading-m">Non accessible content</h2>
    <p class="govuk-body">The content listed below is non-accessible for the following reasons.</p>
    <p class="govuk-body">Non compliance with the accessibility regulations</p>
    <ul class="govuk-list--bullet govuk-list">
        <li>accessibility problems</li>
    </ul>

    <p class="govuk-body">This interface has not been tested with all accessibility technologies.</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>which of the WCAG 2.1 AA success criteria the problem fails on</li>
    </ul>

    <p class="govuk-body">4.1.2 and 4.1.3 have not been tested with all assistive technologies</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>when you plan to fix the problem</li>
    </ul>

    <p class="govuk-body">we plan to continue testing in these areas.</p>

    <h2 class="govuk-heading-m">What we're doing to improve accessibility</h2>
    <p class="govuk-body">This interface has not been tested with all accessibility technologies.</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>which of the WCAG 2.1 AA success criteria the problem fails on</li>
    </ul>

    <p class="govuk-body">4.1.2 and 4.1.3 have not been tested with all assistive technologies</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>when you plan to fix the problem</li>
    </ul>

    <p class="govuk-body">we plan to continue testing in these areas.</p>
    <p class="govuk-body">This statement was prepared on 01 February 2020. It was last updated on 08 October 2020.</p>
@endsection
