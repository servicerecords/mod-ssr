@extends('layouts.app', ['title' => 'Are you the immediate next of kin - '])
@section('pageTitle', 'Are you the immediate next of kin?')

@section('content')
    <form method="post" action="{{ route('applicant-next-of-kin.save') }}" novalidate>

        <p class="govuk-body">The immediate next of kin is the serviceperson’s closest living
            relation from the list.
        </p>

        <x-error-summary :errors="$errors"></x-error-summary>

        <div class="govuk-details__text{{ $errors->first('applicant-next-of-kin') ? ' govuk-!-margin-bottom-7': 'govuk-!-margin-bottom-4' }}">
            <ul class="govuk-list govuk-list--bullet">
                <li>Spouse or Civil Partner</li>
                <li>Son or Daughter</li>
                <li>Grandchild</li>
                <li>Mother  or  Father</li>
                <li>Brother or Sister</li>
                <li>Niece or Nephew</li>
                <li>Grandparent</li>
                <li>Other</li>
            </ul>
        </div>

        <x-radio-group label="Are you the immediate next of kin?"
                       field="applicant-next-of-kin"
                       question-tag="span"
                       :hide-label="true"
                       :options="$options"></x-radio-group>

        <p class="govuk-body">Where the serviceperson died less than 25 years ago, only the immediate next of
            kin will get the career information.</p>

        <x-submit-form></x-submit-form>
    </form>

@endsection
