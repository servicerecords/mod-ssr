<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BigButtonTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Request an historic service record')
                    ->clickLink('Start now')
                    ->assertPathIs('/service')
                    ->assertSee('Details of the serviceperson')
                    ->radio('service', 'Royal Navy / Royal Marines')
                    ->press('Continue')
                    ->assertSee('Did they die in service?')
                    ->radio('death', 'No')
                    ->press('Continue')
                    ->assertSee('Details of the serviceperson')
                    ->type('firstnames', 'John')
                    ->type('lastname', 'Doe')
                    ->type('dob_day', '01')
                    ->type('dob_month', '12')
                    ->type('dob_year', '1960')
                    ->press('Continue')
                    ->assertSee('Details of the serviceperson')
                    ->press('Continue')
                    ->assertSee('Sending documentation')
                    ->attach('certificate', __DIR__ . '/mod-cert-low-low.jpg')
                    ->press('Continue')
                    ->assertSee('Your details')
                    ->type('fullname', 'Joe Bloggs')
                    ->type('email', 'email@domain.co.uk')
                    ->type('address_line_1', '01 Street Name')
                    ->type('address_town', 'London')
                    ->type('address_postcode', 'SW1 8TD')
                    ->type('#location-autocomplete', 'United Kingdom')
                    ->press('#location-autocomplete__option--0')
                    ->radio('use_billing', 'Yes')
                    ->press('Continue')
                    ->assertSee('Your details')
                    ->radio('relationship', 'Son/Daughter')
                    ->press('Continue')
                    ->assertSee('Are you the immediate next of kin?')
                    ->radio('next_of_kin', 'Yes')
                    ->press('Continue')
                    ->assertSee('Check your answers');


        });
    }
}
