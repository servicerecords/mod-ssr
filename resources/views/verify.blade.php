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
                @include('partials.form-errors')
                <div class="govuk-form-group">
                        <label class="govuk-label govuk-label--s">
                            Upload your death certificate
                        </label>
                    <span id="upload-certficate-conditional-hint" class="govuk-hint">
                        We accept, jpg &amp;amp; png file formats.
                    </span>
                    @if($errors->has('certificate'))
                        <span id="certificate-error" class="govuk-error-message">{{$errors->first('certificate')}}</span>
                    @endif
                    <input name="certificate" type="file" accept="image/jpg,image/jpeg,image/png" class="govuk-body {{($errors->has('certificate') ? 'govuk-input--error' : '')}}">
                    {{--                    <div class="govuk-radios govuk-radios--conditional" data-module="radios">--}}
{{--                        <div class="govuk-radios__item">--}}
{{--                            <input class="govuk-radios__input" id="upload-certficate-conditional" name="verify_method" type="radio" value="upload" aria-controls="conditional-upload-certficate-conditional" aria-expanded="false" tabindex="2" checked="checked">--}}
{{--                            <label class="govuk-label govuk-radios__label govuk-label--s" for="upload-certficate-conditional">I'll--}}
{{--                                upload a scan or photograph now</label>--}}
{{--                            <span id="upload-certficate-conditional-hint" class="govuk-hint">--}}
{{--                                We accept, jpg, png &amp; pdf file formats. The file being uploaded must be under 2mb (megabytes) in size.--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden" id="conditional-upload-certficate-conditional">--}}
{{--                            <input name="certificate" type="file" accept="application/pdf,image/jpg,image/jpeg,image/png" class="govuk-body">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="govuk-form-group govuk-!-margin-5">
                    @csrf

                    <button type="submit" class="govuk-button">
                        Continue
                    </button>
                </div>
            </fieldset>
        </div>
    </form>

@endsection
