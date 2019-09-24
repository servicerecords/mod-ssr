@extends('layouts.app')

@section('title', 'Your details')

@section('content')

    <form action="/your-details/relation" method="post" class="govuk-form" id="requester-relationship" novalidate="novalidate">

        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">

            @include('partials.form-errors')

            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">
                        Are you related to the Serviceman/woman?
                    </h2>
                </legend>

                <div class="govuk-radios govuk-radios--inline">
                    @if($errors->first('related'))
                        <span id="service-error" class="govuk-error-message">{{$errors->first('related')}}</span>
                    @endif
                    <div class="govuk-radios__item">
                        <input {{ (old('related') == "Yes" || (isset($your_details_relation['related']) && $your_details_relation['related'] == "Yes")) ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="related" name="related" value="Yes">
                        <label class="govuk-label govuk-radios__label" for="related">Yes</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('related') == "No" || (isset($your_details_relation['related']) && $your_details_relation['related'] == "No")) ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="related" name="related" value="No">
                        <label class="govuk-label govuk-radios__label" for="related">No</label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <button type="submit" class="govuk-button">Save and continue</button>
        </div>
    </form>

@endsection