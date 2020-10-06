@extends('layouts.app')


@section('title', 'Sending documentation')

@section('content')

    <form action="/verify" method="post" class="govuk-form" enctype="multipart/form-data">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            <fieldset class="govuk-fieldset" aria-describedby="upload-certficate-conditional-hint">
                <legend class="govuk-fieldset__legend govuk-fieldset__heading">
                    <h2 class="govuk-heading govuk-heading-m">
                        Death certificate required
                    </h2>
                </legend>

                <p class="govuk-body">
                    Upload your death certificate in .jpg, .png or .pdf formats. Keep the .pdf file image to a single page.
                    Ensure image is clear and shows all of the death certificate.
                </p>

                @include('partials.form-errors')
                <div class="govuk-form-group">
                    <label class="govuk-label govuk-label--s">
                        Upload your death certificate
                    </label>
                    @if($errors->has('certificate'))
                        <span id="certificate-error"
                              class="govuk-error-message">{{$errors->first('certificate')}}</span>
                    @endif
                    <input name="certificate" type="file" accept="image/jpg,image/jpeg,image/png,application/pdf" id="certificate"
                           class="govuk-body {{($errors->has('certificate') ? 'govuk-input--error' : '')}}">
                </div>

                @include('partials.form-continue')
            </fieldset>
        </div>
    </form>

@endsection
