@extends('layouts.app')

@section('pageTitle', 'Cookies on Apply for a deceased’s military record')

@section('content')
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
        <li>
            <strong>Cookies that measure website use</strong>
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
                    <th scope="col" class="govuk-table__header">Name</th>
                    <th scope="col" class="govuk-table__header">Purpose</th>
                    <th scope="col" class="govuk-table__header">Expires</th>
                </tr>
                </thead>

                <tbody class="govuk-table__body">
                @foreach($cookies['usage'] as $cookie)
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">{{ $cookie['name'] }}</td>
                        <td class="govuk-table__cell">{{ $cookie['purpose'] }}</td>
                        <td class="govuk-table__cell">{{ $cookie['expires'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <form method="post" action="{{ route('cookie-policy.save') }}" novalidate>
                @csrf
                <x-radio-group label="Did they die in service?"
                               :hide-legend="true"
                               field="allow-usage"
                               :options="[
                                    ['value' => \App\Models\Constant::YES, 'label' => 'Use cookies that measure my website use', 'children' => []],
                                    ['value' => \App\Models\Constant::NO , 'label' => 'Do not use cookies that measure my website use', 'children' => []]
                               ]"></x-radio-group>
                <x-submit-form :can-cancel="false" submit-label="Save Preferences"></x-submit-form>
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
                    <th scope="col" class="govuk-table__header">Name</th>
                    <th scope="col" class="govuk-table__header">Purpose</th>
                    <th scope="col" class="govuk-table__header">Expires</th>
                </tr>
                </thead>

                <tbody class="govuk-table__body">
                @foreach($cookies['essential'] as $cookie)
                    <tr class="govuk-table__row">
                        <td class="govuk-table__cell">{{ $cookie['name'] }}</td>
                        <td class="govuk-table__cell">{{ $cookie['purpose'] }}</td>
                        <td class="govuk-table__cell">{{ $cookie['expires'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p class="govuk-body">Find out more about cookies on <a
                    href="https://www.gov.uk/help/cookie-details">GOV.UK</a></p>
        </li>
    </ul>

@endsection
