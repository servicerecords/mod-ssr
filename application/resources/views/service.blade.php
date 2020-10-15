@extends('layouts.app')


@section('title', 'Details of the serviceperson')

@section('content')

    <p class="govuk-body">This application process will not tell you if a record is held.</p>

    <form action="/service" method="post" class="govuk-form" id="service" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">
                        Which service did they last serve in?
                    </h2>
                </legend>
                @if($errors->first('service'))
                    <span id="service-error" class="govuk-error-message">{{$errors->first('service')}}</span>
                @endif
                <div class="govuk-radios">
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('service') == 'Royal Navy / Royal Marines' || $service== 'Royal Navy / Royal Marines') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="navy" name="service" value="Royal Navy / Royal Marines">
                        <label class="govuk-label govuk-radios__label" for="navy">Royal Navy or Royal Marines</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('service') == 'Army' || $service == 'Army') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="army" name="service" value="Army">
                        <label class="govuk-label govuk-radios__label" for="army">Army (including Territorial &amp; Army
                            Emergency Reserve)</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('service') == 'Royal Air Force (RAF)' || $service == 'Royal Air Force (RAF)') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="raf" name="service" value="Royal Air Force (RAF)">
                        <label class="govuk-label govuk-radios__label" for="raf">Royal Air Force (RAF)</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('service') == 'Home Guard' || $service == 'Home Guard') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="home-guard" name="service" value="Home Guard">
                        <label class="govuk-label govuk-radios__label" for="home-guard">Home Guard</label>
                    </div>
                </div>
            </fieldset>

            @include('partials.form-continue')
        </div>
    </form>



@endsection
