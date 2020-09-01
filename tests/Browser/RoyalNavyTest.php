<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RoyalNavyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegularServicePersonSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Request an historic service record');

            $browser->click('a.govuk-button.govuk-button--start')
                ->assertSee('Details of the serviceperson')
                ->assertSee('Royal Navy or Royal Marines');

            $browser->radio('#navy', 'Royal Navy / Royal Marines')
                ->press('Continue')
                ->assertSee('Did they die in service?');

            $browser->radio('#no', 'no')
                ->press('Continue')
                ->assertSee('Details of the serviceperson');

            $browser->assertSee('First name(s)')
                ->assertSee('Last name')
                ->assertSee('Place of birth (optional)')
                ->assertSee('Date of birth')
                ->assertSee('For example, 31 3 1910. A year of birth is required.');

            $browser->type('firstnames', 'Test Service Person')
                ->type('lastname', 'User')
                ->type('birth_place', 'United Kingdom')
                ->type('dob_day', '31')      // <-- This should be properly tested
                ->type('dob_month', '3')     // <-- This should be properly tested
                ->type('dob_year', '1910')   // <-- This should be properly tested (future years, etc)
                ->press('Continue');

            $browser->assertSee('Official Service number (optional)');
            $browser->waitForText('Continue');
            $browser->press('Continue');

            $browser->assertSee('Sending documentation');
            $browser->attach('certificate', __DIR__ . '/mod-cert-low-low.jpg');
            $browser->press('Continue');

            $browser->screenshot('post-photo.jpg');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegularServicePersonDiedInServiceSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Request an historic service record');

            $browser->click('a.govuk-button.govuk-button--start')
                ->assertSee('Details of the serviceperson')
                ->assertSee('Royal Navy or Royal Marines');

            $browser->radio('#navy', 'Royal Navy / Royal Marines')
                ->press('Continue')
                ->assertSee('Did they die in service?');

            $browser->radio('#yes', 'yes')
                ->press('Continue')
                ->assertSee('Details of the serviceperson');

            $browser->assertSee('First name(s)')
                ->assertSee('Last name')
                ->assertSee('Place of birth (optional)')
                ->assertSee('Date of birth')
                ->assertSee('For example, 31 3 1910. A year of birth is required.');

            // Check we get an error message when submitting an empty form
        });
    }
}
