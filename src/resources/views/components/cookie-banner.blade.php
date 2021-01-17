<div id="global-cookie-message" class="govuk-clearfix" data-module="cookie-banner" role="region"
     aria-label="cookie banner" data-nosnippet="" style="display: none;">
    <div class="govuk-cookie-message__request govuk-width-container">
        <div class="govuk-grid-row">
            <div class="govuk-grid-column-two-thirds">
                <div>
                    <h2 class="govuk-heading-m">Tell us whether you accept cookies</h2>
                    <p class="govuk-body">We use <a class="govuk-link" href="{{ route('cookie-policy') }}">cookies to collect
                            information</a> about how you use GOV.UK. We use this information to make the website work
                        as well as possible and improve government services.</p>
                </div>
                <div>
                    <div
                        class="govuk-grid-column-full govuk-grid-column-one-half-from-desktop govuk-!-padding-0 govuk-!-padding-right-3">
                        <button class="govuk-button govuk-!-width-full govuk-!-margin-bottom-1" type="submit"
                                data-module="track-click" data-accept-cookies="true" data-track-category="cookieBanner"
                                data-track-action="Cookie banner accepted">Accept all cookies
                        </button>
                    </div>
                    <div
                        class="govuk-grid-column-full govuk-grid-column-one-half-from-desktop govuk-!-padding-0 govuk-!-padding-left-3">
                        <a class="govuk-button govuk-!-width-full govuk-!-margin-bottom-1" role="button"
                           data-module="track-click" data-track-category="cookieBanner"
                           data-track-action="Cookie banner settings clicked" href="{{ route('cookie-policy') }}">Set cookie
                            preferences</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="govuk-cookie-message__accepted govuk-width-container" tabindex="-1">
        <p class="govuk-body" role="alert">You’ve accepted all cookies.
            You can <a class="govuk-link" href="{{ route('cookie-policy') }}" data-module="track-click"
                       data-track-category="cookieBanner"
                       data-track-action="Cookie banner settings clicked from confirmation">change your cookie
                settings</a> at any time.
        </p>
        <a href="#" class="govuk-hide-button govuk govuk-link" data-hide-cookie-banner="true" data-module="track-click"
           data-track-category="cookieBanner" data-track-action="Hide cookie banner">Hide<span class="govuk-visually-hidden"> cookies message</span></a>
    </div>
</div>
