<div class="govuk-form-group @error($field) govuk-form-group--error @enderror">
    <fieldset class="govuk-fieldset">
        @if(!$hideLegend)
            <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
                <h1 class="govuk-fieldset__heading">{{ $label }}{{ !$mandatory ? ' (optional)' : '' }}</h1>
            </legend>
        @endif
        <x-hint :hint="$hint" :field="$field"></x-hint>
        <x-error-message :field="$field"></x-error-message>
        <div class="govuk-radios{{ sizeof($options) === 2  ? ' govuk-radios--inline' : ''}}{{ $hasConditionals ? ' govuk-radios--conditional' : '' }}"
            @if($hasConditionals) data-module="govuk-radios" @endif>
            @foreach($options as $option)
                <x-radio-button :label="$option['label']" :value="$option['value'] ?? $option['label']"
                                :field="$field"
                                :children="$option['children']"></x-radio-button>
            @endforeach
        </div>
    </fieldset>
</div>
