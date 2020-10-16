<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeedbackTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testFeedbackPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/feedback')
                ->assertSee('Give feedback');
        });
    }

}
