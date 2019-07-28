<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceTest extends DuskTestCase
{
	public function testStartPage()
	{
		$this->browse(function(Browser $browser){
			$browser->visit('/service')
				->assertSee('Details of the serviceman/woman')
				->radio('service', 'Royal Navy / Royal Marines')
				->click('.govuk-button')
				->see('Death in service');
		});
	}
}
