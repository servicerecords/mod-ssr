<div
    class="govuk-form-group @if($errors->get($field .'-day') || $errors->get($field .'-month') || $errors->get($field .'-year')) govuk-form-group--error @endif"
    aria-describedby="@if($hint){{ $field }}-hint @endif @error($field) {{ $field }}-year-error @enderror">
    <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory" :hidden="false"></x-label>
    <x-hint :hint="$hint" :field="$field"></x-hint>
    <x-error-message :field="$field"></x-error-message>
    <x-error-message :field="$field .'-day'"></x-error-message>
    <x-error-message :field="$field .'-month'"></x-error-message>
    <x-error-message :field="$field .'-year'"></x-error-message>
    <div class="govuk-date-input" id="{{ $field }}">
        @if(!$hideDay)
            <div class="govuk-date-input__item">
                <div class="govuk-form-group">
                    @if(!$hideDayLabel)
                        <label class="govuk-label govuk-date-input__label" for="{{ $field }}-day">
                            {{ $dayLabel }}
                        </label>
                    @endif
                    <input
                        class="govuk-input govuk-date-input__input govuk-input--width-2 @error($field .'-day') govuk-input--error @enderror"
                        id="{{ $field }}-day"
                        name="{{ $field }}-day" type="text" pattern="[0-9]*" inputmode="numeric"
                        value="{{ old($field. '-day', session($field. '-day')) }}">
                </div>
            </div>
        @endif

        @if(!$hideMonth)
            <div class="govuk-date-input__item">
                <div class="govuk-form-group">
                    @if(!$hideMonthLabel)
                        <label class="govuk-label govuk-date-input__label" for="{{ $field }}-month">
                            {{ $monthLabel }}
                        </label>
                    @endif
                    <input
                        class="govuk-input govuk-date-input__input govuk-input--width-2 @error($field .'-month') govuk-input--error @enderror"
                        id="{{ $field }}-month"
                        name="{{ $field }}-month" type="text" pattern="[0-9]*" inputmode="numeric"
                        value="{{ old($field . '-month', session($field. '-month')) }}">
                </div>
            </div>
        @endif

        @if(!$hideYear)
            <div class="govuk-date-input__item">
                <div class="govuk-form-group">
                    @if(!$hideYearLabel)
                        <label class="govuk-label govuk-date-input__label" for="{{ $field }}-year">
                            {{ $yearLabel }}
                        </label>
                    @endif
                    <input
                        class="govuk-input govuk-date-input__input govuk-input--width-4  @error($field .'-year') govuk-input--error @enderror"
                        id="{{ $field }}-year"
                        name="{{ $field }}-year" type="text" pattern="[0-9]*" inputmode="numeric"
                        value="{{ old($field. '-year', session($field. '-year')) }}">
                </div>
            </div>
        @endif
    </div>
</div>
