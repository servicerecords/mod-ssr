<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RequestTest extends TestCase
{
	use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
	 * @test
     */
    public function a_user_can_start_a_request()
    {
        $response = $this->get('/request');

        $response->assertSeeText('Whose service record are you requesting');
        $response->assertSeeText('Save and continue');
    }

    /**
	 * @test
	 */
    public function a_user_save_their_request_choice()
	{
		$request = [
			'reqtype' => 'Deceased',
		];

		$response = $this->post('/request', $request);
		$response->assertStatus(302);
		$response->assertRedirect('/service');
	}
}
