<div class="govuk-form-group @error($field) govuk-form-group--error @enderror">
    <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory" :hidden="false"></x-label>
    <x-hint :hint="$hint" :field="$field"></x-hint>
    <x-error-message :field="$field"></x-error-message>
    <input class="govuk-file-upload @error($field) govuk-file-upload--error @enderror" id="{{ $field }}"
           name="{{ $field }}" type="file"
           aria-describedby="{{ $field }}-hint @error($field) {{ $field }}-error @enderror"
           value="{{ old($field, session($field)) }}">
</div>
