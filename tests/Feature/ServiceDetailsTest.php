<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceDetailsTest extends TestCase
{
	public function setUp() : void
	{
		//Session::start();
		//$this->startSession();
		parent::setUp();
	}

	//NAVY STARTS
	/**
	 * @test
	 */
	public function user_can_see_navy_details_no_death_form()
	{
		$this->withSession(['service' => 'Royal Navy / Royal Marines', 'death_in_service' => ['death' => 'No']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Date they joined the Royal Navy/Royal Marines');
		$response->assertSeeText('Date they left');
	}

	/**
	 * @test
	 */
	public function user_can_see_navy_details_with_death_form()
	{
		$this->withSession(['service' => 'Royal Navy / Royal Marines', 'death_in_service' => ['death' => 'Yes']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Date they joined the Royal Navy/Royal Marines');
		$response->assertSeeText('Date of death in service');
	}
	//NAVY ENDS

	//ARMY STARTS
	/**
	 * @test
	 */
	public function user_can_see_army_details_with_no_death_form()
	{
		$this->withSession(['service' => 'Army', 'death_in_service' => ['death' => 'No']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Year of discharge');
	}

	/**
	 * @test
	 */
	public function save_army_details_no_death_with_aer()
	{
		$stub = [
			'service_number' => '123456',
			'discharge_year' => '2018',
			'regt_corps' => 'ABC 123',
			'leave_army_reason' => 'Normal demobilisation after 1939/1945 War',
			'completion_info' => 'Territorial Army (TA)',
			'aer_army_number' => '5678910',
			'aer_regt_corps' => 'XYZ 890',
			'ta_army_dates' => '01/01/1912',
			'aer_dates' => '??/??/??',
			'discharge_date' => '??/??/2018',
			'disability_benefit' => 'No',
			'join_date' => '??/??/??'
		];
		$response = $this->post('/service-details', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas('service_details', $stub);
	}

	/**
	 * @test
	 */
	public function save_army_details_no_death_with_ta()
	{
		$stub = [
			'service_number' => '123456',
			'discharge_year' => '2018',
			'regt_corps' => 'ABC 123',
			'leave_army_reason' => 'Normal demobilisation after 1939/1945 War',
			'completion_info' => 'Territorial Army (TA)',
			'ta_army_number' => '5678910',
			'ta_army_regt_corps' => 'XYZ 890',
			'ta_army_dates' => '01/01/1912',
			'join_date' => '??/??/??',
			'discharge_date' => '??/??/2018',
			'disability_benefit' => 'No'
		];
		$response = $this->post('/service-details', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas('service_details', $stub);
	}
	//ARMY ENDS


	//RAF STARTS
	/**
	 * @test
	 */
	public function user_can_see_raf_details_no_death_form()
	{
		$this->withSession(['service' => 'Royal Air Force (RAF)', 'death_in_service' => ['death' => 'No']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Date they joined the RAF');
		$response->assertSeeText('Date they left the RAF');
	}

	/**
	 * @test
	 */
	public function user_can_see_raf_details_with_death_form()
	{
		$this->withSession(['service' => 'Royal Air Force (RAF)', 'death_in_service' => ['death' => 'Yes']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Date they joined the RAF');
		$response->assertSeeText('Date of casualty / aircraft loss');
	}

	/**
	 * @test
	 */
	public function user_can_save_raf_details()
	{
		$stub = [
			'service_number' => '123456',
			'join_day' => '01',
			'join_month' => '01',
			'join_year' => '2000',
			'discharge_day' => '01',
			'discharge_month' => '01',
			'discharge_year' => '2002',
			'join_date' => '01/01/2000',
			'discharge_date' => '01/01/2002',
		];

		$response = $this->post('/service-details', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas('service_details', $stub);

	}
	//RAF ENDS

	//HOME GUARD STARTS
	/**
	 * @test
	 */
	public function can_see_home_guard_form_no_death()
	{
		$this->withSession(['service' => 'Home Guard', 'death_in_service' => ['death' => 'No']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Address on enlistment');
		$response->assertSeeText('In which county did they serve?');
	}

	/**
	 * @test
	 */
	public function can_see_home_guard_form_with_death()
	{
		$this->withSession(['service' => 'Home Guard', 'death_in_service' => ['death' => 'Yes']]);
		$response = $this->get('/service-details');
		$response->assertStatus(200);
		$response->assertSeeText('Address on enlistment');
		$response->assertSeeText('In which county did they serve?');
		$response->assertSeeText('Date of death');
	}

	/**
	 * @test
	 */
	public function can_save_home_guard_details()
	{
		$stub = [
			'service_number' =>'123456',
			'join_day' => '12',
			'join_month' => '12',
			'join_year' => '2000',
			'discharge_day' => '12',
			'discharge_month' => '12',
			'discharge_year' => '2012',
			'further_info' => 'Some more information about the application',
			'join_date' => '12/12/2000',
			'discharge_date' => '12/12/2012',
			'county' => 'Yorkshire',
			'address' => '123 The Road Village Town Postcode',
			'leave_address' => 'Yes',
			'discharge_address' => '456 The Road Village Town Postcode',
			'battalions_companies' => 'Battalions Companies'
		];

		$response = $this->post('/service-details', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas('service_details', $stub);

	}
	//HOME GUARD ENDS

	/**
	 * @test
	 */
	public function save_service_details()
	{
		$stub = [
			'service_number' =>'123456',
			'join_day' => '12',
			'join_month' => '12',
			'join_year' => '2000',
			'discharge_day' => '12',
			'discharge_month' => '12',
			'discharge_year' => '2012',
			'further_info' => 'Some more information about the application',
			'join_date' => '12/12/2000',
    		'discharge_date' => '12/12/2012'
		];

		$response = $this->post('/service-details', $stub);
		$response->assertStatus(302);
		$response->assertSessionHas('service_details', $stub);
	}


	/**
	 * @test
	 */
	public function information_must_include_firstname(){
		$postParams = [
			'firstnames' => '',
			'lastname' => 'Bloggs',
			'dob_year' => '1987',
			'dob_accurate' => 'No'
		];
		$this->get('/essential-information');
		$response = $this->post('/essential-information', $postParams);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHasErrors(['firstnames']);
		$this->followRedirects($response)->assertSeeText('Please enter any first names');
	}

	/**
	 * @test
	 */
	public function information_must_include_lastname(){
		$this->get('/essential-information');
		$postParams = [
			'firstnames' => 'Joe',
			'lastname' => '',
			'dob_year' => '1987',
			'dob_accurate' => 'No'
		];
		$this->get('/essential-information');
		$response = $this->post('/essential-information', $postParams);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHasErrors(['lastname']);
		$this->followRedirects($response)->assertSeeText('Please enter a last name');
	}

	/**
	 * @test
	 */
	public function information_must_include_four_digit_length(){
		$postParams = [
			'firstnames' => 'Joe',
			'lastname' => 'Bloggs',
			'dob_year' => '',
			'dob_accurate' => 'No'
		];
		$this->get('/essential-information');
		$response = $this->post('/essential-information', $postParams);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHasErrors(['dob_year']);
		$this->followRedirects($response)->assertSeeText("The date of birth&#039;s year must be 4 characters in length");
	}

	/**
	 * @test
	 */
	public function information_must_include_dob_accurate_flag(){
		$this->get('/essential-information');
		$postParams = [
			'firstnames' => 'Joe',
			'lastname' => 'Bloggs',
			'dob_year' => '1987',
			'dob_accurate' => ''
		];
		$this->get('/essential-information');
		$response = $this->post('/essential-information', $postParams);
		$response->assertRedirect('/essential-information');
		$response->assertSessionHasErrors(['dob_accurate']);
		$this->followRedirects($response)->assertSeeText('Please specify whether the date of birth is accurate');
	}

	/**
	 * @test
	 */
	public function user_can_see_essential_information_form(){
		$response = $this->get('/essential-information');
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
