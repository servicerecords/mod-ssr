<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\Traits\Interactions;
use Tests\DuskTestCase;

class RoyalNavyTest extends DuskTestCase
{
    use Interactions;

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

            $this->completeServicepersonDetails($browser);

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

            $this->completeServicepersonDetails($browser);

            // Check we get an error message when submitting an empty form
        });
    }
}
