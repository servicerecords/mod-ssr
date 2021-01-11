@props([
    'accessibleLabel' => '',
    'label'     => '',
    'field'     => '',
    'period'    => '',
    'hideLabel' => false,
])

<div class="govuk-date-input__item">
    <div class="govuk-form-group">
        @if(!$hideLabel)
            <label class="govuk-label govuk-date-input__label" for="{{ $field }}-{{ $period }}">
                @if($accessibleLabel)<span class="govuk-visually-hidden">{{ $accessibleLabel }}</span>@endif
                {{ $label }}
            </label>
        @endif<input
            class="govuk-input govuk-date-input__input govuk-input--width-2 @error($field .'-' . $period) govuk-input--error @enderror"
            id="{{ !$hideLabel ? $field . '-' . $period : $field }}"
            name="{{ $field }}-{{ $period }}" type="text" pattern="[0-9]*" inputmode="numeric"
            value="{{ old($field . '-' . $period, session($field. '-' . $period)) }}">

    </div>
</div>
