@if($characterLimit)
    <div class="govuk-character-count" data-module="govuk-character-count" data-maxlength="{{ $characterLimit }}">
        @endif
        <div class="govuk-form-group">
            <x-label :field="$field" :label="$label" :extra="$labelExtra" :mandatory="$mandatory"
                     :hidden="false"></x-label>
            <x-hint :hint="$hint" :field="$field"></x-hint>
            <textarea class="govuk-textarea @if($characterLimit) govuk-js-character-count @endif" id="{{ $field }}"
                      name="{{ $field }}" rows="5"
                      @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                      aria-describedby="@if($characterLimit){{ $field }}-info @endif">{{ old($field, session($field)) }}</textarea>
            @if($characterLimit)
                <div id="{{ $field }}-info" class="govuk-hint govuk-character-count__message" aria-live="polite">
                    You can enter up to {{ $characterLimit }} characters
                </div>
        </div>
        @endif
    </div>
