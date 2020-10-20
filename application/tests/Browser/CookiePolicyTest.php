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
                ->quit();
        });
    }

}
