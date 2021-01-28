<div class="govuk-form-group">
    <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
        @if(trim($label) !== '')
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
            <h1 class="govuk-fieldset__heading">{{ $label }}{{ !$mandatory ? ' (optional)' : '' }}</h1>
        </legend>
        @endif
        <x-hint :hint="$hint"></x-hint>
        <x-error-message :field="$field"></x-error-message>
        <div class="govuk-checkboxes" data-module="govuk-checkboxes">
            @foreach($options as $option)
                <x-checkbox :label="$option['label']" :value="$option['value'] ?? $option['label']"
                            :field="$field . ( $option['field'] ?? '[]')"
                            :is-grouped="true" :children="$option['children']"></x-checkbox>
            @endforeach
        </div>
    </fieldset>
</div>
