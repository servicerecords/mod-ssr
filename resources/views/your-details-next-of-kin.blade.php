@extends('layouts.app')

@section('title', 'Are you the immediate next of kin?')

@section('content')

    <form action="/your-details/next-of-kin" method="post" class="govuk-form" id="service_dis" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <fieldset class="govuk-fieldset">
                @if($errors->first('next_of_kin'))
                    <span id="service-error" class="govuk-error-message">{{$errors->first('next_of_kin')}}</span>
                @endif

                <div class="govuk-radios govuk-radios--inline">
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('next_of_kin') == "Yes" || (isset($next_of_kin['next_of_kin']) && $next_of_kin['next_of_kin'] == "Yes")) ? 'checked' : '' }} class="govuk-radios__input"
                            id="next_of_kin" name="next_of_kin" type="radio" value="Yes">
                        <label class="govuk-label govuk-radios__label" for="next_of_kin">
                            Yes
                        </label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('next_of_kin') == "No" || (isset($next_of_kin['next_of_kin']) && $next_of_kin['next_of_kin'] == "No")) ? 'checked' : '' }} class="govuk-radios__input"
                            id="next_of_kin_2" name="next_of_kin" type="radio" value="No">
                        <label class="govuk-label govuk-radios__label" for="next_of_kin_2">
                            No
                        </label>
                    </div>
                </div>
                <div class="govuk-form-group govuk-!-margin-top-5">
                    @csrf
                    <button type="submit" class="govuk-button">Continue</button>
                </div>
            </fieldset>
        </div>
    </form>

@endsection
