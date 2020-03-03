@extends('layouts.app')

@section('title', 'Your details')

@section('content')

    <form action="/your-details" method="post" class="govuk-form" id="requestor-info" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend">
                    We require these details to contact you and post any matching service record/s to you
                </legend>

               @include('partials.form-errors')

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="fullname">Your full name</label>
                    @if($errors->has('fullname'))
                        <span id="fullname-error" class="govuk-error-message">{{$errors->first('fullname')}}</span>
                    @endif
                    <input value="{{ isset($your_details['fullname'] ) ? $your_details['fullname'] : old('fullname') }}" class="govuk-input {{"" !== $errors->first('fullname') ? 'govuk-input--error' : ''}}" id="fullname" name="fullname" type="text" spellcheck="false" aria-required="true" aria-describedby="{{null !== $errors->first('fullname') ? 'fullname-error' : ''}}">
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="fullname">Your email address</label>
                    @if($errors->has('email'))
                        <span id="email-error" class="govuk-error-message">{{$errors->first('email')}}</span>
                    @endif
                    <input value="{{ isset($your_details['email'] ) ? $your_details['email'] : old('email') }}" class="govuk-input {{"" !== $errors->first('email') ? 'govuk-input--error' : ''}}" id="email" name="email" type="text" spellcheck="false" aria-required="true" aria-describedby="{{null !== $errors->first('email') ? 'email-error' : ''}}">
                </div>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-line-1">
                        Building and street <span class="govuk-visually-hidden">line 1 of 2</span>
                    </label>
                    @if($errors->has('address_line_1'))
                        <span id="address-line-1-error" class="govuk-error-message">Enter your house name/number and street address</span>
                    @endif
                    <input value="{{ isset($your_details['address_line_1'] ) ? $your_details['address_line_1'] : old('address_line_1') }}" class="govuk-input {{"" !== $errors->first('address_line_1') ? 'govuk-input--error' : ''}}" id="address-line-1" name="address_line_1" type="text" aria-required="true" aria-describedby="{{null !== $errors->first('address_line_1') ? 'address-line-1-error' : ''}}">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-line-2">
                        <span class="govuk-visually-hidden">Building and street line 2 of 2</span>
                    </label>
                    <input value="{{ isset($your_details['address_line_2'] ) ? $your_details['address_line_2'] : old('address_line_2') }}" class="govuk-input" id="address-line-2" name="address_line_2" type="text">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-town">
                        Town or city
                    </label>
                    <input value="{{ isset($your_details['address_town'] ) ? $your_details['address_town'] : old('address_town') }}" class="govuk-input govuk-!-width-two-thirds" id="address_town" name="address_town" type="text">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-postcode">
                        Postcode
                    </label>
                    @if($errors->first('address_postcode'))
                        <span id="address-postcode-error" class="govuk-error-message">Enter your postcode or zipcode for your address</span>
                    @endif
                    <input value="{{ isset($your_details['address_postcode'] ) ? $your_details['address_postcode'] : old('address_postcode') }}" class="govuk-input govuk-input--width-10 {{"" !== $errors->first('address_postcode')}} ? 'govuk-input--error' : ''}}" id="address-postcode" name="address_postcode" type="text" aria-required="true" aria-describedby="{{null !== $errors->first('address_postcode') ? 'address-postcode-error' : ''}}">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-postcode">
                        Country
                    </label>
                    <select name="country" class="govuk-select">
                        @foreach($countries as $key => $value)
                            <option value="{{$key}}" {{ ($key === "GB") ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="telephone">
                        Telephone Number
                    </label>
                    <span id="telephone-number-hint" class="govuk-hint">
                        For international numbers include the country code, this field is optional for UK addresses.
                    </span>
                    @if($errors->first('telephone'))
                        <span id="telephone-error" class="govuk-error-message">Enter your telephone number</span>
                    @endif
                    <input value="{{ isset($your_details['telephone'] ) ? $your_details['telephone'] : old('telephone') }}" class="govuk-input govuk-input--width-10 {{"" !== $errors->first('telephone')}} ? 'govuk-input--error' : ''}}" id="telephone" name="telephone" type="text" aria-required="true" aria-describedby="{{null !== $errors->first('telephone') ? 'telephone-error' : ''}}">
                </div>

                <div class="govuk-form-group">
                    <fieldset class="govuk-fieldset">

                        <legend class="govuk-fieldset__legend govuk-fieldset__heading">
                            <h2 class="govuk-heading govuk-heading-m">
                                Use these details for billing?
                            </h2>
                        </legend>

                        <div class="govuk-radios">
                            <div class="govuk-radios__item">
                                <input id="radio-inline-1" type="radio" name="use_billing" value="Yes" class="govuk-radios__input">
                                <label for="radio-inline-1" class="govuk-label govuk-radios__label govuk-label--s">Yes</label>
                            </div>
                            <div class="govuk-radios__item">
                                <input id="radio-inline-2" type="radio" name="use_billing" value="No" class="govuk-radios__input">
                                <label for="radio-inline-2" class="govuk-label govuk-radios__label govuk-label--s">No</label>
                            </div>
                        </div>

                    </fieldset>
                </div>


            </fieldset>
        </div>
        <div class="govuk-form-group">
            @csrf
            <button type="submit" class="govuk-button">Continue</button>
        </div>
    </form>

@endsection
