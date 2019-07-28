<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StartTest extends DuskTestCase
{
    /**
	  *
	  *
	  * @return void
	  */
    public function testStartPage()
	 {
	 	$this->browse(function(Browser $browser){
	 		$browser->visit('/')
				->assertSee(env('APP_NAME'))
	 			->clickLink('Start now');
				//->assertSee('Whose service record are you requesting?');
		});
	 }
}
