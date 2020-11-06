@props([
'submitLabel' => 'Save and continue',
'cancelLabel' => 'Cancel application',
'canCancel' => true
])
<div class="govuk-form-group">
    @csrf
    <button class="govuk-button govuk-!-margin-right-2" data-module="govuk-button">{{ $submitLabel }}</button>
    @if($canCancel)
        <button class="govuk-button govuk-button--secondary" data-module="govuk-button">{{ $cancelLabel }}</button>
    @endif
</div>
