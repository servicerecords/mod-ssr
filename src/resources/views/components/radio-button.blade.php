<div class="govuk-radios__item">
    <input class="govuk-radios__input" id="{{ $_id }}" name="{{ $field }}" type="radio"
           value="{{ $value }}" @if(old($field, session($field)) === $value) checked @endif
           @if($children) data-aria-controls="conditional-{{ $_id }}" aria-expanded="false"@endif>
    <label class="govuk-label govuk-radios__label" for="{{ $_id }}">{{ $label }}</label>
</div>
@if($children)
    <div class="govuk-radios__conditional govuk-radios__conditional--hidden" id="conditional-{{ $_id }}">
        @foreach($children as $child)
            @switch($child['type'])
                @case('x-checkbox')
                <x-checkbox :label="$child['label']" :value="$child['value'] ?? $child['label']"
                            :field="$field . '-' . $child['field']"></x-checkbox>
                @break

                @case('x-radio-button')
                <x-radio-button :label="$child['label']" :value="$child['value'] ?? $child['label']"
                                :field="$field . '-' . $child['field']"></x-radio-button>
                @break

                @case('x-textfield')
                <x-textfield :label="$child['label']"
                             :field="$field . '-' . $child['field']" :hint="$child['hint'] ?? ''"
                             :mandatory="$child['mandatory'] ?? true"></x-textfield>
                @break
            @endswitch
        @endforeach
    </div>
@endif

