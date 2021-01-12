@php
    $ariaDescribedBy = [];
    if($hint) $ariaDescribedBy[] = $field . '-hint';
    if($errors->first($field)) $ariaDescribedBy[] = $field . '-error';
@endphp
<div class="govuk-form-group @error($field) govuk-form-group--error @enderror">
    <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory"
             :hidden="$hideLabel"></x-label>
    <x-hint :hint="$hint" :field="$field"></x-hint>
    <x-error-message :field="$field"></x-error-message>
    <input
        class="govuk-input @if(!$fullWidth)govuk-!-width-two-thirds @endif @error($field) govuk-input--error @enderror"
        id="{{ $field }}" name="{{ $field }}" type="{{ $type }}"
        @if(!$spellcheck)spellcheck="false" @endif @if($autocomplete)autocomplete="{{ $autocomplete }}"
        @endif @if(!$maxlength) maxlength="120" @endif @if($autocomplete === 'tel') inputmode="numeric" pattern="[0-9]*" @endif
        value="{{ old($field, session($field)) }}"
        @if($ariaDescribedBy)
        aria-describedby="{{ join(' ', $ariaDescribedBy) }}"
        @endif
    >
</div>
