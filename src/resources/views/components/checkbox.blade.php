<div class="govuk-checkboxes__item">
    @if(is_bool($value))
        <input id="{{ $_id }}--default" name="{{ $field }}" type="hidden" value="{{ (int)!$value }}">
    @elseif($value === \App\Models\Constant::YES)
        <input id="{{ $_id }}--default" name="{{ $field }}" type="hidden" value="{{ \App\Models\Constant::NO }}">
    @elseif($value === \App\Models\Constant::NO)
        <input id="{{ $_id }}--default" name="{{ $field }}" type="hidden" value="{{ \App\Models\Constant::YES }}">
    @endif
    <input class="govuk-checkboxes__input" id="{{ $_id }}" name="{{ $field }}" type="checkbox"
           value="{{ $value }}" @if(old($field, session($field)) == $value) checked @endif
           @if($children) data-aria-controls="conditional-{{ $_id }}" @endif>
    <label class="govuk-label govuk-checkboxes__label" for="{{ $_id }}">{{ $label }}</label>
</div>
@if($children)
    <div class="govuk-checkboxes__conditional govuk-checkboxes__conditional--hidden" id="conditional-{{ $_id }}">
        @foreach($children as $child)
            <x-textfield :label="$child['label']" :field="$field . '-' . $child['field']" :hint="$child['hint'] ?? ''"
                         :mandatory="$child['mandatory'] ?? true"></x-textfield>
        @endforeach
    </div>
@endif
