@extends('layouts.app')

@section('title', 'Give feedback')

@section('content')

    <form action="/feedback" method="post" class="govuk-form">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">

            @include('partials.form-errors')

            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset" aria-describedby="changed-name-hint">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                        <h1 class="govuk-fieldset__heading">
                           Overall how do you feel about the service you received today?
                        </h1>
                    </legend>
                    <div class="govuk-radios">
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input"
                                   id="service_1"
                                   name="service"
                                   type="radio"
                                   value="Very satisfied"/>
                            <label class="govuk-label govuk-radios__label" for="service_1">Very satisfied</label>
                        </div>

                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input"
                                   id="service_2"
                                   name="service"
                                   type="radio"
                                   value="Satisfied"/>
                            <label class="govuk-label govuk-radios__label" for="service_2">Satisfied</label>
                        </div>

                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input"
                                   id="service_3"
                                   name="service"
                                   type="radio"
                                   value="Neither satisfied or dissatisfied"/>
                            <label class="govuk-label govuk-radios__label" for="service_3">Neither satisfied or dissatisfied</label>
                        </div>

                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input"
                                   id="service_4"
                                   name="service"
                                   type="radio"
                                   value="Dissatisfied"/>
                            <label class="govuk-label govuk-radios__label" for="service_4">Dissatisfied</label>
                        </div>

                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input"
                                   id="service_5"
                                   name="service"
                                   type="radio"
                                   value="Very dissatisfied"/>
                            <label class="govuk-label govuk-radios__label" for="service_5">Very dissatisfied</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset" aria-describedby="changed-name-hint">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                        <h1 class="govuk-fieldset__heading">
                           How could we improve this service?
                        </h1>
                    </legend>
                    <span id="more-detail-hint" class="govuk-hint">
                        Do not include personal or financial information, like your National Insurance number or credit card details. (Limit is 1200 characters)
                    </span>
                    <textarea class="govuk-textarea" id="more_detail" name="more_detail" rows="5" aria-describedby="more-detail-hint"></textarea>
                </fieldset>
            </div>
            <div class="govuk-form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button class="govuk-button" data-module="govuk-button">
                    Send feedback
                </button>
            </div>
        </div>
    </form>

@endsection
