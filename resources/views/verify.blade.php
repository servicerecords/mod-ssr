@extends('layouts.app')


@section('title', 'Documentation')

@section('content')

    <form action="/verify" method="post" class="govuk-form" enctype="multipart/form-data">
        <div class="govuk-form-group">
            <fieldset class="govuk-fieldset">
                <legend class="govuk-fieldset__legend govuk-fieldset__heading">
                    <h2 class="govuk-heading govuk-heading-m">
                        Death certificate required
                    </h2>
                    <p>
                        As the Serviceman/woman did not die in service, we will require a
                        death certificate to complete your service record request.
                    </p>
                </legend>
                <div class="govuk-form-group">
                    <div class="govuk-radios govuk-radios--conditional" data-module="radios">
                        <div class="govuk-radios__item">
                            <input type="radio" class="govuk-radios__input" name="verify_method" value="post" id="post" tabindex="1">
                            <label class="govuk-label govuk-radios__label govuk-label--s">I'll post a copy of a death certificate
                                along with my
                                request.</label>
                        </div>
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" id="upload-certficate-conditional" name="verify_method" type="radio" value="upload" aria-controls="conditional-upload-certficate-conditional" aria-expanded="false" tabindex="2">
                            <label class="govuk-label govuk-radios__label govuk-label--s" for="upload-certficate-conditional">I'll
                                upload a scan or photograph now</label>
                        </div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden" id="conditional-upload-certficate-conditional">
                            <input name="certificate" type="file" accept="application/pdf" class="govuk-body">
                        </div>
                    </div>
                </div>

                <div class="govuk-form-group">
                    <details class="govuk-details" role="group">
                        <summary class="govuk-details__summary" role="button" aria-controls="details-content-bf5bacbe-5d67-4c1a-be8f-ad2466e12b24" aria-expanded="false">
                <span class="govuk-details__summary-text">
                  Why we need a death certificate
                </span>
                        </summary>
                        <div class="govuk-details__text" id="details-content-bf5bacbe-5d67-4c1a-be8f-ad2466e12b24" aria-hidden="true">
                            Unless the serviceperson died in service or it is greater than 116 years since their date of
                            birth you will need to provide a copy of their death certificate with your request.
                        </div>
                    </details>
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
