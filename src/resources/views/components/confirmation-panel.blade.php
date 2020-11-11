@props([
    'message' => 'Application complete',
    'reference' => 'UNKNOWN'
])
<div class="govuk-panel govuk-panel--confirmation">
    <h1 class="govuk-panel__title">
        {{ $message }}
    </h1>
    <div class="govuk-panel__body">
        Your reference number<br><strong>{{ session('application-reference') }}</strong>
    </div>
</div>
