<div class="govuk-form-group @error($field) govuk-form-group--error @enderror">
    <a id="{{ $field }}"></a>
    <fieldset class="govuk-fieldset">
        @if($label)
            @if(!$hideLegend)
                <legend class="govuk-fieldset__legend govuk-fieldset__legend--m{{ $hideLabel ? ' govuk-visually-hidden': '' }}">
                    <{{ $questionTag }} class="govuk-fieldset__heading">{{ $label }}{{ !$mandatory ? ' (optional)' : '' }}</{{ $questionTag }}>
                </legend>
            @endif
        @endif
        <x-hint :hint="$hint" :field="$field"></x-hint>
        <x-error-message :field="$field"></x-error-message>
        <div
            class="govuk-radios{{ sizeof($options) === 2  ? ' govuk-radios--inline' : ''}}{{ $hasConditionals ? ' govuk-radios--conditional' : '' }}"
            @if($hasConditionals) data-module="govuk-radios" @endif>
            @foreach($options as $option)
                <x-radio-button :label="$option['label']" :value="$option['value'] ?? $option['label']"
                                :field="$field"
                                :children="$option['children']"></x-radio-button>
            @endforeach
        </div>
    </fieldset>
</div>
