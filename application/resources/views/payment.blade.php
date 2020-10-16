@extends('layouts.app')

@section('title', 'Enter card details')

@section('content')

    <form id="card-details" name="cardDetails" method="POST" action="/pay">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--s">Card Number</label>
                @if($errors->has('card_number'))
                    <span id="card_number-error" class="govuk-error-message">{{$errors->first('card_number')}}</span>
                @endif
                <input id="card_number" type="tel" name="card_number" value="{{ old('card_number') }}"
                       class="govuk-input {{"" !== $errors->first('card_number') ? 'govuk-input--error' : ''}}"/>
            </div>
        </div>
        <div class="govuk-form-group">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend">
                    <p class="govuk-fieldset__heading govuk-label--s">Expiry date</p>
                    <span class="govuk-hint govuk-!-margin-bottom-0">For example, 10/20</span>
                </legend>
                <div
                    class="govuk-date-input__item govuk-date-input__item--month govuk-date-input__item--with-separator">
                    <label class="govuk-label">Month</label>
                    @if($errors->has('expiration_month'))
                        <span id="card_number-error"
                              class="govuk-error-message">{{$errors->first('expiration_month')}}</span>
                    @endif
                    <input type="number"
                           class="govuk-input govuk-input--width-3 {{"" !== $errors->first('expiration_month') ? 'govuk-input--error' : ''}}"
                           id="expiration_month" value="{{ old('expiration_month') }}" name="expiration_month"/>
                </div>
                <div class="govuk-date-input__item govuk-date-input__item--year">
                    <label class="govuk-label">Year</label>
                    @if($errors->has('expiration_year'))
                        <span id="card_number-error"
                              class="govuk-error-message">{{$errors->first('expiration_year')}}</span>
                    @endif
                    <input type="number"
                           class="govuk-input govuk-input--width-3 {{"" !== $errors->first('expiration_year') ? 'govuk-input--error' : ''}}"
                           id="expiration_year" value="{{ old('expiration_year') }}" name="expiration_year"/>
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group">
            <label class="govuk-label govuk-label--s">Name on card</label>
            @if($errors->has('name_on_card'))
                <span id="card_number-error" class="govuk-error-message">{{$errors->first('name_on_card')}}</span>
            @endif
            <input id="name_on_card" type="text" name="name_on_cold" maxlength="200"
                   class="govuk-input {{"" !== $errors->first('name_on_card') ? 'govuk-input--error' : ''}}"
                   value="{{ old('name_on_card') }}"/>
        </div>
        <div class="govuk-form-group">
            <label class="govuk-label govuk-label--s">Card security code</label>
            <span class="govuk-hint">The last 3 digits on the back of the card</span>
            @if($errors->has('cvc'))
                <span id="card_number-error" class="govuk-error-message">{{$errors->first('name_on_card')}}</span>
            @endif
            <input type="number" name="cvc"
                   class="govuk-input govuk-input--width-3 {{"" !== $errors->first('cvc') ? 'govuk-input--error' : ''}}"
                   id="cvc" value="{{ old('cvc') }}"/>
        </div>
        <div class="govuk-form-group pay-!-border-top govuk-!-padding-top-4">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-legend">
                    <h2 class="govuk-heading-m">Billing address</h2>
                    <span class="govuk-hint">This is the address associated with the card</span>
                </legend>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-line-1">
                        Building and street <span class="govuk-visually-hidden">line 1 of 2</span>
                    </label>
                    @if($errors->has('address_line_1'))
                        <span id="address-line-1-error" class="govuk-error-message">Enter your house name/number and street address</span>
                    @endif
                    <input class="govuk-input {{"" !== $errors->first('address_line_1') ? 'govuk-input--error' : ''}}"
                           id="address-line-1" name="address_line_1" type="text" aria-required="true"
                           aria-describedby="{{"" !== $errors->first('address_line_1') ? 'address-line-1-error' : ''}}">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-line-2">
                        <span class="govuk-visually-hidden">Building and street line 2 of 2</span>
                    </label>
                    <input class="govuk-input" id="address-line-2" name="address_line_2" type="text">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-town">
                        Town or city
                    </label>
                    <input class="govuk-input govuk-!-width-two-thirds" id="address_town" name="address_town"
                           type="text">
                </div>

                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s" for="address-county">
                        County
                    </label>
                    @if($errors->first('address_county'))
                        <span id="address-county-error"
                              class="govuk-error-message">Enter the county of your address</span>
                    @endif
                    <input
                        class="govuk-input govuk-!-width-two-thirds {{"" !== $errors->first('address_county') ? 'govuk-input--error' : ''}}"
                        id="address-county" name="address_county" type="text" aria-required="true"
                        aria-describedby="{{"" !== $errors->first('address_line_1') ? 'address-county-error' : ''}}">
                </div>

                <div class="govuk-form-group govuk-error">
                    <label class="govuk-label govuk-label--s" for="address-postcode">
                        Postcode
                    </label>
                    @if($errors->first('address_postcode'))
                        <span id="address-postcode-error" class="govuk-error-message">Enter your postcode or zipcode for your address</span>
                    @endif
                    <input
                        class="govuk-input govuk-input--width-10 {{"" !== $errors->first('address_postcode')}} ? 'govuk-input--error' : ''}}"
                        id="address-postcode" name="address_postcode" type="text" aria-required="true"
                        aria-describedby="{{"" !== $errors->first('address_postcode') ? 'address-postcode-error' : ''}}">
                </div>
            </fieldset>
        </div>
        <div class="govuk-form-group pay-!-border-top govuk-!-padding-top-4">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-legend">
                    <h2 class="govuk-heading-m">Contact details</h2>
                    <span class="govuk-hint">We'll send your payment confirmation here</span>
                </legend>
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s">Email</label>
                    <input type="email" name="email" value="{{ old('value') }}" class="govuk-input"/>
                </div>
            </fieldset>
        </div>
        @include('partials.form-continue')
    </form>
@endsection
