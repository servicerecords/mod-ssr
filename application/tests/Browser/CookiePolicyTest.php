<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CookiePolicyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCookiePolicyDisplaysOnFirstVisit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertPresent('#global-cookie-message')
                ->assertButtonEnabled('Accept all cookies')
                ->click('#global-cookie-message button')
                ->assertHasCookie('cookies_preferences_set', false)
                ->assertSeeIn('#global-cookie-message', 'You’ve accepted all cookies')
                ->refresh()
                ->assertMissing('#global-cookie-message')
                ->quit();

            $browser->visit('/')
                ->assertMissing('#global-cookie-message');

            $browser->screenshot('quitting.png');
//                ->assertHasCookie('cookies_preferences_set', false);
        });
    }

}
