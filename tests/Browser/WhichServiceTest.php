<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceRequestTest extends DuskTestCase
{
	/**
	 *
	 *
	 * @return void
	 */
	public function testRequestStart()
	{
		$this->browse(function(Browser $browser){
			$browser->visit('/record-request')
				->assertSee(env('Whose service record are you requesting'))
				->radio('reqtype', 'Deceased')
				->click('.govuk-button', '')
				->see('In which service did they serve?');
		});
	}
}
