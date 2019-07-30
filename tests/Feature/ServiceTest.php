<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ServiceTest extends TestCase
{
	//use WithoutMiddleware;

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
        $response = $this->get('/', [], [], ['HTTP_REFERER' => 'testing']);

        $response->assertStatus(200);
    }

	/**
	 * @test
	 */
	public function a_user_can_see_the_service_form()
	{
		$response = $this->get('/service');
		//$response->dump();

		$response->assertStatus(200);
		$response->assertSeeText('Details of the serviceman/woman');
		$response->assertSeeText('Save and continue');
	}

	/**
	 * @test
	 */
	public function a_user_can_make_a_service_selection()
	{

		$postData = [
			'service' => 'Home Guard'
		];

		$response = $this->post('/service', $postData);
		$response->assertStatus(302);
		$response->assertRedirect('/service/death-in-service');
		$response->assertSessionHas('service', $postData['service']);
	}

    /**
	 * @test
	 */
    public function a_user_must_select_a_service()
	{
		$postData = [];

		$this->get('/service');

		$response = $this->post('/service', $postData);
		$response->assertRedirect('/service');
		$response->assertSessionHasErrors(['service']);
		$this->followRedirects($response)->assertSeeText(' There is a problem');
	}
}
