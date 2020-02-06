<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EssentialInformationTest extends TestCase
{
	public function setUp() : void
	{
		//Session::start();
		//$this->startSession();
		parent::setUp();
	}

    /**
	 * @test
	 */
    public function information_must_include_four_digit_length(){
		$postParams = [
			'firstnames' => 'Joe',
			'lastname' => 'Bloggs',
			'dob_year' => '198',
			'dob_accurate' => 'No'
		];
		$this->get('/essential-information', ['HTTP_REFERER' => 'testing']);
		$response = $this->post('/essential-information', $postParams);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHasErrors(['dob_year']);
		$this->followRedirects($response)->assertSeeText("The date of birth&#039;s year must be 4 characters in length");
	}

    /**
	 * @test
	 */
    public function user_can_see_essential_information_form(){
    	$response = $this->get('/essential-information', ['HTTP_REFERER' => 'testing']);
		$response->assertStatus(200);
		$response->assertSeeText('Details of the serviceman/woman');
	}

    /**
	 * @test
	 */
    public function a_user_can_save_essential_information(){
		$postParams = [
			'firstnames' => 'Joe',
			'lastname' => 'Bloggs',
			'dob_year' => '1987',
			'dob_accurate' => 'Yes',
			'dob' => '??/??/1987'
		];

		$response = $this->post('/essential-information', $postParams);
		$response->assertStatus(302);
		$response->assertRedirect('/service-details');
		$response->assertSessionHas('essential_information', $postParams);
	}


}
