@extends('layouts.app')

@section('title', 'Details of the serviceman/woman')

@section('content')

    <form action="/essential-information" method="post" class="govuk-form" id="subject-essentials" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend">
                    <strong>The following details are mandatory</strong> for us to be
                    able to complete a record search. Please complete them as accurately
                    as possible.
                </legend>

                @include('partials.form-errors')

                <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
                    <label class="govuk-label govuk-label--s">First name(s)</label>
                    <span id="info-1-item-hint" class="govuk-hint">Include all middle names</span>
                    <input value="{{ isset($essential_information['firstnames'] ) ? $essential_information['firstnames'] : old('firstnames') }}" class="govuk-input govuk-input--20" id="firstname" name="firstnames" type="text" spellcheck="false">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s">Last name</label>
                    <input value="{{ isset($essential_information['lastname'] ) ? $essential_information['lastname'] : old('lastname') }}" class="govuk-input govuk-input--20" id="lastname" name="lastname" type="text" spellcheck="false">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s">Date of birth</label>
                    <span id="info-2-item-hint" class="govuk-hint">For example, 31 3 1910. Partial dates may be sufficient</span>
                    <div class="govuk-date-input" id="date-of-birth">
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="dob-day">Day</label>
                                <input value="{{ isset($essential_information['dob_day'] ) ? $essential_information['dob_day'] : old('dob_day') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="dob-day" name="dob_day" type="number" pattern="[0-9]*">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="dob-month">Month</label>
                                <input value="{{ isset($essential_information['dob_month'] ) ? $essential_information['dob_month'] : old('dob_month') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="dob-month" name="dob_month" type="number" pattern="[0-9]*">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="dob-year">Year</label>
                                <input value="{{ isset($essential_information['dob_year'] ) ? $essential_information['dob_year'] : old('dob_year') }}" class="govuk-input govuk-date-input__input govuk-input--width-4" id="dob-year" name="dob_year" type="number" pattern="[0-9]*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="govuk-form-group">
                    <fieldset class="govuk-fieldset">
                        <legend class="govuk-fieldset__legend">
                            <strong>Is the date of birth entered above accurate?</strong>
                            <span id="info-3-item-hint" class="govuk-hint govuk-!-margin-0">This is important particularly for common last names</span>
                        </legend>
                        <div class="govuk-radios govuk-radios--inline">
                            <div class="govuk-radios__item">
                                <input {{ (old('dob_accurate') == 'Yes' || $essential_information['dob_accurate'] == 'Yes') ? 'checked' : '' }} class="govuk-radios__input" id="dob_accurate-yes" name="dob_accurate" type="radio" value="Yes">
                                <label class="govuk-label govuk-radios__label govuk-label--s" for="dob_accurate-yes">Yes</label>
                            </div>
                            <div class="govuk-radios__item">
                                <input {{ (old('dob_accurate') == 'No' || $essential_information['dob_accurate'] == 'No') ? 'checked' : '' }} class="govuk-radios__input" id="dob_accurate-no" name="dob_accurate" type="radio" value="No">
                                <label class="govuk-label govuk-radios__label govuk-label--s" for="dob_accurate-no">No</label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="govuk-form-group">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <button type="submit" class="govuk-button">
                        Save and continue
                    </button>
                </div>
            </fieldset>
        </div>
    </form>

@endsection