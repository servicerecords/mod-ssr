<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckYourAnswersTest extends TestCase
{

    /**
     * @test
     */
    public function user_session_being_fedback()
    {
        $response = $this->withSession([
            '_token' => 'test',
            'service' => 'Royal Navy / Royal Marines',
            'service_details' => [
                'service_number' => '123456',
                'discharge_date' => '01/01/1930',
                'join_date' => '01/01/1950'
            ],
            'death_in_service' => [
                'death' => 'Yes'
            ],
            'essential_information' => [
                'firstnames' => 'John',
                'lastname' => 'Doe',
                'dob' => '01/01/1900',
            ],
            'your_details' => [
                'fullname' => 'Joe Bloggs',
                'address_line_1' => '1 The Avenue',
                'address_line_2' => '',
                'address_town' => 'City',
                'address_postcode' => 'Postcode',
                'payment_required' => true
            ],

        ])->get('/check-your-answers');
        $response->assertSeeTextInOrder([
            'Royal Navy / Royal Marines',
            '123456',
            'Yes',
            'John',
            'Doe',
            '01/01/1900',
            '',
            '01/01/1930',
            'Joe Bloggs',
            '1 The Avenue',
            'City',
            'Postcode',
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_next_of_kin_should_not_have_to_make_a_payment()
    {
        $response = $this->withSession([
            '_token' => 'test',
            'service' => 'Royal Navy / Royal Marines',
            'service_details' => [
                'service_number' => '123456',
                'discharge_date' => '01/01/1930',
                'join_date' => '01/01/1950'
            ],
            'death_in_service' => [
                'death' => 'Yes'
            ],
            'essential_information' => [
                'firstnames' => 'John',
                'lastname' => 'Doe',
                'dob' => '01/01/1900',
            ],
            'your_details' => [
                'fullname' => 'Joe Bloggs',
                'address_line_1' => '1 The Avenue',
                'address_line_2' => '',
                'address_town' => 'City',
                'address_postcode' => 'Postcode',
                'payment_required' => false
            ],

        ])->get('/check-your-answers');
        $response->assertSeeText('Accept and send');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function payment_is_required()
    {
        $response = $this->withSession([
            'service' => 'Royal Navy / Royal Marines',
            'service_details' => [
                'service_number' => '123456',
                'discharge_date' => '01/01/1930',
                'join_date' => '01/01/1950'
            ],
            'death_in_service' => [
                'death' => 'Yes'
            ],
            'essential_information' => [
                'firstnames' => 'John',
                'lastname' => 'Doe',
                'dob' => '01/01/1900'
            ],
            'your_details' => [
                'fullname' => 'Joe Bloggs',
                'address_line_1' => '1 The Avenue',
                'address_line_2' => '',
                'address_town' => 'City',
                'address_postcode' => 'Postcode',
                'payment_required' => true
            ],

        ])->get('/check-your-answers');
        $response->assertSeeText('Submit your request');
        $response->assertSeeText('Accept and pay');
        $response->assertStatus(200);
    }
}
