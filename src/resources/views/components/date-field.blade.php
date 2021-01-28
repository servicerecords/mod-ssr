<div
    class="govuk-form-group @if($errors->get($field .'-day') || $errors->get($field .'-month') || $errors->get($field .'-year')) govuk-form-group--error @endif"
    aria-describedby="@if($hint){{ $field }}-hint @endif @error($field) {{ $field }}-year-error @enderror">

    <fieldset class="govuk-fieldset">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
            <h2 class="govuk-fieldset__heading govuk-!-font-weight-regular">
                {{ $label }}
            </h2>
        </legend>

        {{--    <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory" :hidden="false"></x-label>--}}
        <x-hint :hint="$hint" :field="$field"></x-hint>
        <x-error-message :field="$field"></x-error-message>
        <x-error-message :field="$field .'-day'"></x-error-message>
        <x-error-message :field="$field .'-month'"></x-error-message>
        <x-error-message :field="$field .'-year'"></x-error-message>

        <div class="govuk-date-input" id="{{ $field }}">
            @if($singleField)
                <x-date-input :hideLabel="true" :field="$field" :period="$period"></x-date-input>
            @else
                @if(!$hideDay)
                    <x-date-input :hideLabel="$hideDayLabel" :label='$dayLabel' :field="$field"
                                  period="day"></x-date-input>
                @endif
                @if(!$hideMonth)
                    <x-date-input :hideLabel="$hideMonthLabel" :label='$monthLabel' :field="$field"
                                  period="month"></x-date-input>
                @endif
                @if(!$hideYear)
                    <x-date-input :hideLabel="$hideYearLabel" :label='$yearLabel' :field="$field"
                                  period="year"></x-date-input>
                @endif
            @endif
        </div>
    </fieldset>
</div>
