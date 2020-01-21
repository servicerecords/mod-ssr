@extends('layouts.app')


@section('title', 'Details of the Serviceman/woman')

@section('content')
    <form action="/service" method="post" class="govuk-form" id="service" novalidate="novalidate">
        <p class="govuk-body">
            Please provide details about the Serviceman/woman or member of the Home
            Guard whose records you are requesting.
        </p>
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                    <h2 class="govuk-fieldset__heading">
                        In which service did they serve?
                    </h2>
                </legend>
                @if($errors->first('service'))
                    <span id="service-error" class="govuk-error-message">{{$errors->first('service')}}</span>
                @endif
                <div class="govuk-radios">
                    <div class="govuk-radios__item">
                        <input {{ (old('service') == 'Royal Navy / Royal Marines' || $service== 'Royal Navy / Royal Marines') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="navy" name="service" value="Royal Navy / Royal Marines">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="navy">Royal Navy or Royal Marines</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('service') == 'Army' || $service == 'Army') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="army" name="service" value="Army">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="army">Army (including Territorial &amp; Army Emergency Reserve)</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('service') == 'Royal Air Force (RAF)' || $service == 'Royal Air Force (RAF)') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="raf" name="service" value="Royal Air Force (RAF)">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="raf">Royal Air Force (RAF)</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input {{ (old('service') == 'Home Guard' || $service == 'Home Guard') ? 'checked' : '' }} class="govuk-radios__input" type="radio" id="home-guard" name="service" value="Home Guard">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="home-guard">Home Guard</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input class="govuk-radios__input" type="radio" id="other" name="service" value="Unknown">
                        <label class="govuk-label govuk-radios__label govuk-label--s" for="other">Other</label>
                        <span id="service-1-item-hint" class="govuk-hint govuk-radios__hint">
                Without knowing the service, the service record request may not
                be successful and will take longer for us to process. Please
                provide any information that may help in the following forms.
              </span>
                    </div>
                </div>
            </fieldset>
            <div class="govuk-form-group">
                <details class="govuk-details" role="group">
                    <summary class="govuk-details__summary" role="button" aria-controls="details-content-f1dc968c-6b6d-4b21-8489-9f2109e5f478" aria-expanded="false">
              <span class="govuk-details__summary-text">
                Served in more than one service?
              </span>
                    </summary>
                    <div class="govuk-details__text" id="details-content-f1dc968c-6b6d-4b21-8489-9f2109e5f478" aria-hidden="true">
                        You will need to make a separate service record request for each
                        of the service areas in which they served.
                    </div>
                </details>
            </div>
            <div class="govuk-form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button type="submit" class="govuk-button" name="details_service">
                    Save and continue
                </button>
            </div>
        </div>
    </form>



@endsection
