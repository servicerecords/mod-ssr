<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationTest extends TestCase
{
    /**
     * @test
	 *
     */
    public function user_can_see_relation_choices()
    {
        $response = $this->get('/your-details/relation');

        $response->assertStatus(200);
        $response->assertSeeText('Are you related to the Serviceman/woman?');
        $response->assertSeeText('Yes');
        $response->assertSeeText('No');
    }

	/**
	 * @test
	 *
	 */
    public function user_must_submit_an_answer()
	{
		$stub = [
			'related' => ''
		];
		$response = $this->post('/your-details/relation', $stub);
		$response->assertStatus(302);
		$response->assertSessionHasErrors(['related']);

	}

	/**
	 * @test
	 */
	public function user_can_submit_related_yes_answer()
	{
		$stub = [
			'related' => 'Yes'
		];

		$response = $this->post('/your-details/relation', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas(['your_details.relation']);
		$response->assertRedirect('/your-details/relationship');
	}

	/**
	 * @test
	 */
	public function user_can_submit_related_no_answer()
	{
		$stub = [
			'related' => 'No'
		];

		$response = $this->post('/your-details/relation', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas(['your_details.relation']);
		$response->assertRedirect('/check-your-answers');
	}
}
