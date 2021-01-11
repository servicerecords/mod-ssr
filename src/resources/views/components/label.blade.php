@props([
    'label' => 'Unset Label',
    'field' => 'Unset field',
    'extra' => false,
    'mandatory' => true,
    'hidden',
])
<label class="govuk-label" for="{{ $field }}">
    @if($hidden)<span class="govuk-visually-hidden">{{ $label }}</span>@else{{ $label }}@endif
    @if($extra) <span class="govuk-visually-hidden">{{ $extra }}</span>@endif
    @if(!$mandatory) <span>(optional)</span>@endif
</label>
