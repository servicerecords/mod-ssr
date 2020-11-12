@if(count($errors) > 0)
    <div class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1"
         data-module="govuk-error-summary">
        <h2 class="govuk-error-summary__title" id="error-summary-title">
            There is a problem
        </h2>
        <div class="govuk-error-summary__body">
            <ul class="govuk-list govuk-error-summary__list">
                @foreach($errors->getMessages() as $key => $error)
                    <li><a href="#passport-issued-error">The date your passport was issued must be in the past</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
