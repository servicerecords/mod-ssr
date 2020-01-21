@extends('layouts.app')

@section('title', 'Whose service record are you requesting?')

@section('content')

    <form action="/request" method="post" class="govuk-form">
            <div class="govuk-form-group">
                <div class="govuk-radios">
                    <div class="govuk-radios__item">
                        <input class="govuk-radios__input" type="radio" id="reqtype" name="reqtype" value="Deceased" checked="checked">
                        <label class="govuk-label govuk-radios__label" for="reqtype">I'm requesting the records of a
                            deceased Serviceman/woman or Member of the Home Guard.
                            Available to family and non-family members. A death certificate is required if they did
                            not die in service.</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input class="govuk-radios__input" type="radio" id="reqtype-other" name="reqtype" value="other" disabled="disabled">
                        <label class="govuk-label govuk-radios__label" for="reqtype-other">No other options are
                            available for the Alpha version of this service</label>
                    </div>
                </div>
            </div>
            <div class="govuk-form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button type="submit" class="govuk-button">Save and continue</button>
            </div>
            <div class="govuk-form-group">
                <details class="govuk-details" role="group">
                    <summary class="govuk-details__summary" role="button" aria-controls="details-content-0e79c747-0c0d-403f-9f0b-e4de34f2be58" aria-expanded="false">
                            <span class="govuk-details__summary-text">
                                Why and when we need a death certificate
                            </span>
                    </summary>
                    <div class="govuk-details__text" id="details-content-0e79c747-0c0d-403f-9f0b-e4de34f2be58" aria-hidden="true">
                        Where the consent of the immediate next of kin has been given for its release to a third
                        party, the 25 year threshold will not apply allowing the release of all the information
                        available under the publication scheme at any time, subject to payment of an administration
                        fee and the provision of a death certificate (except where death was in service).
                    </div>
                </details>
            </div>
    </form>



@endsection
