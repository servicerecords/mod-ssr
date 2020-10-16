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
                <p class="govuk-body">Where the serviceperson died less than 25 years ago, only the immediate next of
                    kin will get the career information.</p>

                <div class="govuk-form-group">
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
                </div>

                <div class="govuk-form-group">
                    <div class="govuk-details__text" aria-hidden="true">
                        <p class="govuk-body">The immediate next of kin is the serviceperson’s closest living
                            relation from the list below.
                        </p>
                    </div>
                </div>
                <div class="govuk-form-group">
                    <ul class="govuk-list govuk-list--bullet">
                        <li>Spouse/Civil Partner</li>
                        <li>Son/Daughter</li>
                        <li>Grandchild</li>
                        <li>Mother/Father</li>
                        <li>Brother/Sister</li>
                        <li>Niece/Nephew</li>
                        <li>Grandparent</li>
                        <li>Other</li>
                    </ul>
                </div>

                @include('partials.form-continue')
            </fieldset>
        </div>
    </form>

@endsection
