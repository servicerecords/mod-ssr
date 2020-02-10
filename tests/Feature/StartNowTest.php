<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StartNowTest extends TestCase
{
	/**
	 * A user can start the application from the index
	 * @test
	 * @return void
	 */
    public function user_can_start_application()
	 {
	 	$response = $this->get('/');
	 	$response->assertSeeText('Request an historic service record');
	 	$response->assertSeeText('Start now');
	 }
}
