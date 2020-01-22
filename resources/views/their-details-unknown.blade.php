@extends('layouts.app')

@section('title', 'Details of the serviceman/woman')

@section('content')

    <form action="/service-details" method="post" class="govuk-form">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__heading">
                    <h2 class="govuk-heading govuk-heading-m">
                        Other useful information
                    </h2>
                    <p>
                        Please provide any further details if you know them, as it will
                        help us complete and speed up your request.
                    </p>
                </legend>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="service_number">Official Service Number</label>
                    <input value="{{ isset($service_details['service_number'] ) ? $service_details['service_number'] : old('service_number') }}" class="govuk-input govuk-input--width-20" type="text" name="service_number" id="service_number">
                </div>


                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s">Further Information</label>
                    <span id="useful-item-hint" class="govuk-hint">
              Please include any other information that may help indentify the
              service record e.g. Ranks, Grades, Regiments, Nation Insurance
              Number etc.
            </span>
                    <textarea class="govuk-textarea" id="more_detail" name="further_information" rows="5" aria-describedby="useful-item-hint">
                         {{ isset($service_details['further_information'] ) ? $service_details['further_information'] : old('further_information') }}
                    </textarea>
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
