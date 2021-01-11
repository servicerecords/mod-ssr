<div class="govuk-form-group">

    <fieldset class="govuk-fieldset">
        @if(trim($title) !== '')
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h1 class="govuk-fieldset__heading">{{ $title }}</h1>
        </legend>
        @endif

        <p class="govuk-body">
            {{ $subtext }}
        </p>

        {{ $slot }}
    </fieldset>

</div>
