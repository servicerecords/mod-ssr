<?php

namespace Tests\Browser;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FileUploadTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testFileSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Apply for a deceased\'s military record');
        });
    }
}
