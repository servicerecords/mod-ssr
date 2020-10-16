<?php

namespace Tests\Browser\Traits;

use Laravel\Dusk\Browser;

trait Interactions
{
    protected function completeServicepersonDetails(Browser $browser)
    {
        $browser->assertSee('Details of the serviceperson');

        $browser->assertSee('First name(s)')
            ->assertSee('Last name')
            ->assertSee('Place of birth (optional)')
            ->assertSee('Date of birth')
            ->assertSee('For example, 31 3 1910. A year of birth is required.');

        $browser->type('firstnames', 'Test Service Person')
            ->type('lastname', 'User')
            ->type('birth_place', 'United Kingdom')
            ->type('dob_day', '31')
            ->type('dob_month', '3')
            ->type('dob_year', '1910')
            ->press('Continue');

        $browser->assertSee('Official Service number (optional)');
        $browser->waitForText('Continue');
        $browser->press('Continue');
    }

    protected function completeYourDetails(Browser $browser)
    {
        $browser->type('fullname', 'Test User')
            ->type('email', 'toby@codesure.co.uk')
            ->type('address_line_1', '1 Any Street')
            ->type('address_town', 'Any Town')
            ->type('address_postcode', 'AB12 3DE')
//            ->type('#location-autocomplete', 'country:GB')
                ->value('#location-autocomplete', 'United Kingdom')
            ->type('telephone', '01234567890')
            ->radio('use_billing', 'Yes')
            ->press('Continue')
            ->screenshot('complete-details.png');
    }

    protected function clickOnAllLinksOnPage(Browser $browser)
    {
        $links = $browser->elements('a');

        foreach ($links as $link) {
            $link->click();
            $browser->assertDontSee('Page not found'); // The best we can do to assert not a 404
            $browser->back();
        }
    }

    protected function uploadDocument(Browser $browser) {
        $browser->assertSee('Sending documentation');
        $browser->attach('certificate', __DIR__ . '/../test-image.png');
        $browser->press('Continue');
    }
}
