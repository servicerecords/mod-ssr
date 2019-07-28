@extends('layouts.app')

@section('title', 'Death in service')

@section('content')

    <form action="/service/death-in-service" method="post" class="govuk-form" id="service_dis" novalidate="novalidate">
        <p class="govuk-body">
            It's important that we know this, as we may neeed to ask you for a death
            certificate.
        </p>
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">Did they die in service?</h2>
                </legend>
                @if($errors->first('death'))
                    <span id="service-error" class="govuk-error-message">{{$errors->first('death')}}</span>
                @endif
                <div class="govuk-radios">
                    <div class="govuk-radios__item">
                        <input {{ (old('death_in_service') == 'Yes' || $death_in_service['death'] == 'Yes') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="yes" name="death" value="Yes">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="yes">Yes</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('death_in_service') == 'No' || $death_in_service['death'] == 'No') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="no" name="death" value="No">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="no">No</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('death_in_service') == 'Unkown' || $death_in_service['death'] == 'unkown') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="unkown" name="death" value="Unknown">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="unkown">I don't know</label>
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
    </form>

@endsection