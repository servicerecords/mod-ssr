@extends('layouts.app')


@section('title', 'Did they die in service?')

@section('content')

    <form action="/service/death-in-service" method="post" class="govuk-form" id="service_dis" novalidate="novalidate">
        <div class="govuk-form-group {{ count($errors) >0 ? 'govuk-form-group--error' :'' }}">
            @include('partials.form-errors')
            <fieldset class="govuk-fieldset">
                @if($errors->first('death'))
                    <span id="service-error" class="govuk-error-message">{{$errors->first('death')}}</span>
                @endif
                <div class="govuk-radios">
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('death_in_service') == 'Yes' || $death_in_service['death'] == 'Yes') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="yes" name="death" value="Yes">
                        <label class="govuk-label govuk-radios__label" for="yes">Yes</label>
                    </div>
                    <div class="govuk-radios__item">
                        <input
                            {{ (old('death_in_service') == 'No' || $death_in_service['death'] == 'No') ? 'checked' : '' }} class="govuk-radios__input"
                            type="radio" id="no" name="death" value="No">
                        <label class="govuk-label govuk-radios__label" for="no">No</label>
                    </div>
                </div>
            </fieldset>
        </div>

       @include('partials.form-continue')
    </form>

@endsection


@push('scripts')

<script type="text/javascript" src="/assets/location-autocomplete.min.js"></script>
<script type="text/javascript">
    openregisterLocationPicker({
        selectElement: document.getElementById('location-autocomplete'),
        url: '/assets/location-autocomplete-graph.json'
    })
</script>

@endpush
