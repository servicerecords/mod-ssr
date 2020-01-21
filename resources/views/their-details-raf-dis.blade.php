@extends('layouts.app')

@section('title', 'Details of the Serviceman/woman')

@section('content')

    <form action="/service-details" method="post" class="govuk-form" id="subject-raf" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend">
                    Please provide any further details if you know them, as this will
                    help us complete and speed up your request.
                </legend>

                @include('partials.form-errors')

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="service_number">Official Service Number (optional)</label>
                    <input value="{{ isset($service_details['service_number'] ) ? $service_details['service_number'] : old('service_number') }}" class="govuk-input govuk-input--width-10" id="service_number" name="service_number" type="text" spellcheck="false">
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="enlist_date">Date they joined the RAF (optional)</label>
                    <span id="army-dis-1-item-hint" class="govuk-hint">
              Provide as much as you know. Partial dates are okay.
            </span>
                    <div class="govuk-date-input" id="date-of-birth">
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="join_day">
                                    Day
                                </label>
                                <input value="{{ isset($service_details['join_day'] ) ? $service_details['join_day'] : old('join_day') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="join_day" name="join_day" type="number" pattern="[0-9]*" min="0" max="31">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="join_month">
                                    Month
                                </label>
                                <input value="{{ isset($service_details['join_month'] ) ? $service_details['join_month'] : old('join_month') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="join_month" name="join_month" type="number" pattern="[0-9]*" min="0" max="12">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="join_year">
                                    Year
                                </label>
                                <input value="{{ isset($service_details['join_year'] ) ? $service_details['join_year'] : old('join_year') }}" class="govuk-input govuk-date-input__input govuk-input--width-4" id="join_year" name="join_year" type="number" pattern="[0-9]*" min="0" max="2014">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="discharge_date">Date of casualty / aircraft loss (optional)</label>
                    <span id="army-dis-1-item-hint" class="govuk-hint">
              Provide as much as you know. Partial dates are okay.
            </span>
                    <div class="govuk-date-input" id="discharge-date">
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="discharge_day">
                                    Day
                                </label>
                                <input value="{{ isset($service_details['discharge_day'] ) ? $service_details['discharge_day'] : old('discharge_day') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="discharge_day" name="discharge_day" type="number" pattern="[0-9]*" min="0" max="31">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="discharge_month">
                                    Month
                                </label>
                                <input value="{{ isset($service_details['discharge_month'] ) ? $service_details['discharge_month'] : old('discharge_month') }}" class="govuk-input govuk-date-input__input govuk-input--width-2" id="discharge_month" name="discharge_month" type="number" pattern="[0-9]*" min="0" max="12">
                            </div>
                        </div>
                        <div class="govuk-date-input__item">
                            <div class="govuk-form-group">
                                <label class="govuk-label govuk-date-input__label" for="discharge_year">
                                    Year
                                </label>
                                <input value="{{ isset($service_details['discharge_year'] ) ? $service_details['discharge_year'] : old('discharge_year') }}" class="govuk-input govuk-date-input__input govuk-input--width-4" id="discharge_year" name="discharge_year" type="number" pattern="[0-9]*" min="0" max="2014">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="further_information">
                        Further information (optional)
                    </label>
                    <span id="nm-1-item-hint" class="govuk-hint">
              Please include any other information that may help identify the
              service record. e.g. Ranks, Grades, Regiments, National Insurance
              Number etc
            </span>
                    <textarea class="govuk-textarea" id="further_information" name="further_information" rows="5">
                        {{ isset($service_details['further_information'] ) ? $service_details['further_information'] : old('further_information') }}
                    </textarea>
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <button type="submit" class="govuk-button">Save and continue</button>
        </div>
    </form>

@endsection
