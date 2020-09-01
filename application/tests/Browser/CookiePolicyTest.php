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
    public function testCookiePolicyDisplaysWhenFirstVisiting()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertPresent('#global-cookie-message')
                ->assertButtonEnabled('Accept all cookies')
                ->click('#global-cookie-message button')
                ->assertSeeIn('#global-cookie-message', 'You’ve accepted all cookies')
                ->refresh()
                ->assertMissing('#global-cookie-message');
        });
    }
}
