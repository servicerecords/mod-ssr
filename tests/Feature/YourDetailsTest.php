<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YourDetailsTest extends TestCase
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
	 * @test
	 */
    public function user_must_submit_fullname() {

    	$stub = [
    		'fullname' => '',
			'address_line_1' => '1 Road Name',
			'address_line_2' => '',
			'address_town' => 'Town/City',
			'address_county' => 'County',
			'address_postcode' => 'Postcode'
		];

    	$response = $this->post('your-details', $stub);
    	$response->assertSessionHasErrors(['fullname']);
    	$response->assertStatus(302);
	}

	/**
	 * @test
	 */
    public function user_must_submit_building_and_street() {
		$stub = [
			'fullname' => 'John Doe',
			'address_line_1' => '',
			'address_line_2' => '',
			'address_town' => 'Town/City',
			'address_county' => 'County',
			'address_postcode' => 'Postcode'
		];

		$response = $this->post('/your-details', $stub);
		$response->assertSessionHasErrors(['address_line_1']);
		$response->assertStatus(302);
	}

	/**
	 * @test
	 */
    public function user_must_submit_county() {
		$stub = [
			'fullname' => 'John Doe',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => '',
			'address_town' => 'Town/City',
			'address_county' => '',
			'address_postcode' => 'Postcode'
		];

		$response = $this->post('/your-details', $stub);
		$response->assertSessionHasErrors(['address_county']);
		$response->assertStatus(302);
	}

	/**
	 * @test
	 */
    public function user_must_submit_postcode() {
		$stub = [
			'fullname' => 'John Doe',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => '',
			'address_town' => 'Town/City',
			'address_county' => 'County',
			'address_postcode' => ''
		];

		$response = $this->post('/your-details', $stub);
		$response->assertSessionHasErrors(['address_postcode']);
		$response->assertStatus(302);
	}

	/**
	 * @test
	 */
	public function user_can_see_details_form()
	{
		$response = $this->get('/your-details');
		$response->assertStatus(200);
		$response->assertSeeText('Your details');
	}

	/**
	 * @test
	 */
	public function user_can_submit_form() {
		$stub = [
			'fullname' => 'John Doe',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => '',
			'address_town' => 'Town/City',
			'address_county' => 'County',
			'address_postcode' => 'Postcode'
		];

		$response = $this->post('/your-details', $stub);
		$response->assertSessionHas(['your_details']);
		$response->assertStatus(302);
		$response->assertRedirect('/your-details/relation');
	}

}
