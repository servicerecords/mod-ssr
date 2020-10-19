<h2 class="govuk-heading-m">Your Details</h2>

<dl class="govuk-summary-list govuk-!-margin-bottom-9">
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Your name
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('your_details')['fullname'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/change-answer?your-details">
                Change<span class="govuk-visually-hidden"> your name</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Street number and name
        </dt>
        <dd class="govuk-summary-list__value">
            <p class="govuk-body">{{ Session::get('your_details')['address_line_1'] }}</p>
            <p class="govuk-body">{{ Session::get('your_details')['address_line_2'] }}</p>
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/change-answer?your-details">
                Change<span class="govuk-visually-hidden"> address street number and name</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Town/City
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('your_details')['address_town'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/change-answer?your-details">
                Change<span class="govuk-visually-hidden"> town/city</span>
            </a>
        </dd>
    </div>
    <div class="govuk-summary-list__row">
        <dt class="govuk-summary-list__key">
            Postcode
        </dt>
        <dd class="govuk-summary-list__value">
            {{ Session::get('your_details')['address_postcode'] }}
        </dd>
        <dd class="govuk-summary-list__actions">
            <a class="govuk-link" href="/change-answer?your-details">
                Change<span class="govuk-visually-hidden"> postcode</span>
            </a>
        </dd>
    </div>
</dl>

@if(@Session::get('verification')['method'] != '')
    <h2 class="govuk-heading-m">Documentation</h2>
    <dl class="govuk-summary-list govuk-!-margin-bottom-9">
        <div class="govuk-summary-list__row">
            <dt class="govuk-summary-list__key">
                Method of verification
            </dt>
            <dd class="govuk-summary-list__value">
                {{ Session::get('verification')['method'] }}
            </dd>
            <dd class="govuk-summary-list__actions">
                <a class="govuk-link" href="/change-answer?verify">
                    Change
                </a>
            </dd>
        </div>
        @if(Session::get('verification')['uploaded'] != 'No')
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Death certificate required
                </dt>
                <dd class="govuk-summary-list__value">
                    {{ Session::get('verification')['death_certificate'] }}
                </dd>
                <dd class="govuk-summary-list__actions">
                    <a class="govuk-link" href="/change-answer?verify">
                        Change
                    </a>
                </dd>
            </div>
        @endif
    </dl>
@endif
