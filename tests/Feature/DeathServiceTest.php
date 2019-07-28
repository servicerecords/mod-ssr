<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeathServiceTest extends TestCase
{
	public function setUp() : void
	{
		//Session::start();
		//$this->startSession();
		parent::setUp();
	}
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
	 * @test
	 */
    public function a_user_can_see_the_death_in_service_form()
	{
		$response = $this->get('/service/death-in-service');
		$response->assertStatus(200);
		$response->assertSeeText('Death in service');
		$response->assertSeeText('Save and continue');
	}

	/**
	 * @test
	 */
	public function a_user_must_make_a_choice()
	{
		$postData = [];
		$this->get('/service/death-in-service');
		$response = $this->post('/service/death-in-service', $postData);
		//$this->assertRedirect('/service/death-in-service');
		$response->assertSessionHasErrors(['death']);
		$this->followRedirects($response)->assertSeeText(' There is a problem');
	}


	/**
	 * @test
	 */
	public function a_user_can_save_their_death_in_service_choice()
	{
		$postData = [
			'death' => 'Yes'
		];
		//$this->get('/service/death-in-service');
		$response = $this->post('/service/death-in-service', $postData);
		$response->assertStatus(302);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHas('death_in_service.death', $postData['death']);
	}
}
