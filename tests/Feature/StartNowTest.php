<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StartNowTest extends TestCase
{
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
	 * A user can start the application from the index
	 * @test
	 * @return void
	 */
    public function user_can_start_application()
	 {
	 	$response = $this->get('/');
	 	$response->assertSeeText('Service record request');
	 	$response->assertSeeText('Start now');
	 }
}
