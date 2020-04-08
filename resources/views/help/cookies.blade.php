@extends('layouts.app');

@section('title', '');

@section('content')

    <h1 class="govuk-heading-l">Cookies on search for an historic service record</h1>

    <p class="govuk-body">Cookies are files saved on your computer, tablet or telephone when you visit a website.
        The online request an historic service record service puts cookies onto your computer in order to:</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>remember what messages you’ve seen so you’re not shown them again</li>
        <li>understand how you use the service so we can update and improve it</li>
        <li>temporarily store information you enter to support your application</li>
    </ul>

    <h2 class="govuk-heading-m">Cookie settings</h2>
    <p class="govuk-body">We use 3 types of cookie:</p>
    <ul class="govuk-list govuk-list--number">
        <li><strong>Cookies that measure website use</strong>
            <p class="govuk-body">We use Google Analytics to measure how you found, access and use the website so we can improve it,
                based on user needs. We do not allow Google to use or share the data about how you use this site.</p>

            <p class="govuk-body">Google Analytics stores anonymised information about:</p>
            <ul class="govuk-list govuk-list--bullet">
                <li>how you got to the site</li>
                <li>the pages you visit on search for an historic service record and how long you spend on each page</li>
                <li>what you click on while you're visiting the site</li>
            </ul>

            <p class="govuk-body">No personal details are stored with this information, so you can’t be identified.</p>

            <table class="govuk-table">
                <thead class="govuk-table__head">
                    <tr class="govuk-table__row">
                        <th scope="col" class="govuk-table__header">
                            Name
                        </th>
                        <th scope="col" class="govuk-table__header">
                            Purpose
                        </th>
                        <th scope="col" class="govuk-table__header">
                            Expires
                        </th>
                    </tr>
                </thead>

                <tbody class="govuk-table__body">
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">_ga</td>
                        <td class="govuk-table__cell">
                            Used to distinguish users
                        </td>
                        <td class="govuk-table__cell">
                            2 years
                        </td>
                    </tr>
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">_gat</td>
                        <td class="govuk-table__cell">
                            Used to throttle request rate
                        </td>
                        <td class="govuk-table__cell">
                            10 minutes
                        </td>
                    </tr>
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">_gcl_au</td>
                        <td class="govuk-table__cell">
                            Used by Google AdSense for experimenting with advertisement efficiency across websites using their services
                        </td>
                        <td class="govuk-table__cell">
                            3 months
                        </td>
                    </tr>
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">_gid</td>
                        <td class="govuk-table__cell">
                            Used to distinguish users
                        </td>
                        <td class="govuk-table__cell">
                            24 hours
                        </td>
                    </tr>
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">_gac</td>
                        <td class="govuk-table__cell">
                            Contains campaign related information for the user
                        </td>
                        <td class="govuk-table__cell">
                            90 days
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="govuk-body">Google isn't allowed to use or share our analytics data.</p>
        </li>

        <li>
            <strong>Session Cookies that remember your settings</strong>
            <p class="govuk-body">Session cookies remember your preferences and the choices you make to personalise your experience of using the site.
                They only exist while the session is in progress and will be deleted when the service completes.
                We use session cookies to hold the information you enter.  This service will not work if you do not allow these cookies to be used.
            </p>
            <p class="govuk-body">If you choose to stop the application before completion, some personal data (yours or your subjects)
                may be retained in session cookies on your computer.  You can clear this cookie data in the normal way,
                via browser settings or by searching for “clearing cookie data” for a method specific to your browser.
            </p>
            <p class="govuk-body">
                If you do not agree with the use of these cookies, then you will not be able to use this service.
                Applications can be made using a paper-based application. Use link the link <a href="https://www.gov.uk/get-copy-military-service-records">https://www.gov.uk/get-copy-military-service-records</a>.
            </p>
        </li>

        <li>
            <strong>Strictly necessary cookies</strong>
            <p class="govuk-body">These essential cookies do things like remember your progress through a form (for example a licence application) they always need to be on.</p>
            <p class="govuk-body">Find out more about cookies on <a href="https://www.gov.uk/help/cookie-details">GOV.UK</a></p>
        </li>

    </ul>

@endsection
