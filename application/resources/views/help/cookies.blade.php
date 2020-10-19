@extends('layouts.app')

@section('title', '')

@section('content')

    <h1 class="govuk-heading-l">Cookies on Apply for a deceased’s military record</h1>
    <p class="govuk-body">Cookies are files saved on your computer, tablet or telephone when you visit a website.
        The online Apply for a deceased’s military record service puts cookies onto your computer in order to:</p>
    <ul class="govuk-list govuk-list--bullet">
        <li>remember what messages you’ve seen so you’re not shown them again</li>
        <li>understand how you use the service so we can update and improve it</li>
        <li>temporarily store information you enter to support your application</li>
    </ul>
    <p class="govuk-body">
        After your application is completed, or if you choose to leave the application process before completion,
        close the browser session to delete any data you have entered
    </p>
    <h2 class="govuk-heading-m">Cookie settings</h2>
    <p class="govuk-body">We use 2 types of cookie:</p>
    <ul class="govuk-list govuk-list--number">
        <li><strong>Cookies that measure website use</strong>
            <p class="govuk-body">We use Google Analytics to measure how you found, access and use the website so we can
                improve it, based on user needs. We do not allow Google to use or share the data about how you use this
                site.</p>

            <p class="govuk-body">Google Analytics stores anonymised information about:</p>

            <ul class="govuk-list govuk-list--bullet">
                <li>how you got to the site</li>
                <li>the pages you visit on search for {{ env('APP_NAME', 'Apply for a deceased\'s military record') }}
                    and how long you spend on each page
                </li>
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
                        Used by Google AdSense for experimenting with advertisement efficiency across websites using
                        their services
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

            <form action="/help/cookies" method="post" class="govuk-form">
                @csrf
                <div class="govuk-form-group">
                    <div class="govuk-radios">
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" type="radio" id="tracking-yes" name="tracking"
                                   value="yes" rel="usage-policy"
                                   @if($tracking === 'yes') checked="checked" @endif>

                            <label class="govuk-label govuk-radios__label" for="tracking-yes">Use cookies that measure
                                my website use</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" type="radio" id="tracking-no" name="tracking"
                                   value="no" rel="usage-policy"
                                   @if($tracking !== 'yes') checked="checked" @endif>
                            <label class="govuk-label govuk-radios__label" for="tracking-no">Do not use cookies that
                                measure my website use</label>
                        </div>
                    </div>
                </div>
            </form>
            <p class="govuk-body">Google isn't allowed to use or share our analytics data.</p>
        </li>

        <li>
            <strong>Strictly necessary cookies</strong>
            <p class="govuk-body">These essential cookies do things like remember your progress through a form (for
                example to remember your answers to our questions ). They always need to be on.</p>

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
                    <td class="govuk-table__cell">XSRF-TOKEN</td>
                    <td class="govuk-table__cell">
                        A standard cookie used to prevent a malicious exploit of a website
                    </td>
                    <td class="govuk-table__cell">
                        2 hours
                    </td>
                </tr>
                <tr class="govuk-table__row">
                    <td class="govuk-table__cell">apply_for_a_deceaseds_military_record_session</td>
                    <td class="govuk-table__cell">
                        Holds session data to complete the application
                    </td>
                    <td class="govuk-table__cell">
                        End of session
                    </td>
                </tr>
                <tr class="govuk-table__row">
                    <td class="govuk-table__cell">cookies_Preference_set</td>
                    <td class="govuk-table__cell">
                        Registers the input cookie preference
                    </td>
                    <td class="govuk-table__cell">
                        End of session
                    </td>
                </tr>
                <tr class="govuk-table__row">
                    <td class="govuk-table__cell">cookies_policy</td>
                    <td class="govuk-table__cell">
                        Register the response to cookies permission question
                    </td>
                    <td class="govuk-table__cell">
                        End of session
                    </td>
                </tr>
                </tbody>
            </table>

            <p class="govuk-body">Find out more about cookies on <a
                    href="https://www.gov.uk/help/cookie-details">GOV.UK</a></p>
        </li>
    </ul>

@endsection

@push('mod-scripts')
    <script>
        const radioElements = document.querySelectorAll('[rel="usage-policy"]')
        let policy = JSON.parse(window.GOVUK.getCookie('cookies_policy'))

        radioElements.forEach(function (element) {
            element.addEventListener('change', function(input) {
                policy['usage'] = input.target.value == 'no' ? false : true
                window.GOVUK.setCookie('cookies_policy', JSON.stringify(policy), {days: 0} )
                window.GOVUK.setCookie('cookies_preferences_set', true, {days: 0} )
            })
        })


        if(policy['usage'] === false) {
            document.getElementById('tracking-yes').checked = false
            document.getElementById('tracking-no').checked = true
        } else {
            document.getElementById('tracking-yes').checked = true
            document.getElementById('tracking-no').checked = false
        }
    </script>
@endpush
