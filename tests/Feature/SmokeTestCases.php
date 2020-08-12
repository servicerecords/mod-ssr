<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SmokeTestCases extends TestCase
{
    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function smokeTestPayment()
    {
        $response = $this->get('/');
        $response->assertSeeText('Start now');

        $response = $this->get('/service');
        $response->assertSeeText('Which service did they last serve in?');
        $response = $this->post('/service', ['service' => 'Royal Navy / Royal Marines']);
        $response->assertRedirect('/service/death-in-service');
        $response = $this->get('/service/death-in-service');
        $response->assertSeeText('Did they die in service?');
        $response = $this->post('/service/death-in-service', ['death' => 'No']);
        $response->assertRedirect('/essential-information');
        $response = $this->get('/essential-information');
        $response->assertSeeText('Details of the serviceperson');
        $response = $this->post('/essential-information', ['firstnames' => 'Joe', 'lastname' => 'Bloggs', 'birth_place' => 'London', 'dob_day' => "12", 'dob_month' => "02", 'dob_year' => "1950"]);
        $response->assertRedirect('/service-details');
        $response = $this->get('/service-details');
        $response->assertSeeText('Official Service number (optional)');
        $response = $this->post('/service-details', []);
        $response->assertRedirect('/verify');

        Storage::fake('verfication');
        $response = $this->post('/verify', [
            'certificate' => UploadedFile::fake()->image('certificate.jpg')
        ]);

        $response->assertRedirect('/your-details');

        $response = $this->get('/your-details');
        $response->assertSeeText('Your details');
        $response = $this->post('/your-details', ['fullname' => 'John Doe', 'email' => 'john.doe@emai.com', 'address_line_1' => 'London Road', 'address_town' => 'London', 'address_postcode' => 'SW19 1TD', 'country' => 'GB', 'use_billing' => 'Yes']);
        $response->assertRedirect('/your-details/relationship');

        $response = $this->get('/your-details/relationship');
        $response->assertSee('How are you related to the serviceperson?');

        $response = $this->post('/your-details/relationship', ['relationship' => 'Grandchild']);
        $response->assertRedirect('your-details/next-of-kin');

        $response = $this->get('/your-details/next-of-kin');
        $response->assertSee('Are you the immediate next of kin?');

        $response = $this->post('/your-details/next-of-kin', ['next_of_kin' => 'No']);
        $response->assertRedirect('/check-your-answers');

        $response = $this->get('/pay');
        $response->assertRedirect();

    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function smokeTestNoPayment()
    {
        $response = $this->get('/');
        $response->assertSeeText('Start now');

        $response = $this->get('/service');
        $response->assertSeeText('Which service did they last serve in?');
        $response = $this->post('/service', ['service' => 'Royal Navy / Royal Marines']);
        $response->assertRedirect('/service/death-in-service');
        $response = $this->get('/service/death-in-service');
        $response->assertSeeText('Did they die in service?');
        $response = $this->post('/service/death-in-service', ['death' => 'No']);
        $response->assertRedirect('/essential-information');
        $response = $this->get('/essential-information');
        $response->assertSeeText('Details of the serviceperson');
        $response = $this->post('/essential-information', ['firstnames' => 'Joe', 'lastname' => 'Bloggs', 'birth_place' => 'London', 'dob_day' => "12", 'dob_month' => "02", 'dob_year' => "1950"]);
        $response->assertRedirect('/service-details');
        $response = $this->get('/service-details');
        $response->assertSeeText('Official Service number (optional)');
        $response = $this->post('/service-details', []);
        $response->assertRedirect('/verify');

        Storage::fake('verfication');
        $response = $this->post('/verify', [
            'certificate' => UploadedFile::fake()->image('certificate.jpg')
        ]);

        $response->assertRedirect('/your-details');

        $response = $this->get('/your-details');
        $response->assertSeeText('Your details');
        $response = $this->post('/your-details', ['fullname' => 'John Doe', 'email' => 'john.doe@emai.com', 'address_line_1' => 'London Road', 'address_town' => 'London', 'address_postcode' => 'SW19 1TD', 'country' => 'GB', 'use_billing' => 'Yes']);
        $response->assertRedirect('/your-details/relationship');

        $response = $this->get('/your-details/relationship');
        $response->assertSee('How are you related to the serviceperson?');

        $response = $this->post('/your-details/relationship', ['relationship' => 'Son/Daughter']);
        $response->assertRedirect('your-details/next-of-kin');

        $response = $this->get('/your-details/next-of-kin');
        $response->assertSee('Are you the immediate next of kin?');

        $response = $this->post('/your-details/next-of-kin', ['next_of_kin' => 'Yes']);
        $response->assertRedirect('/check-your-answers');

        $response = $this->get('/confirmation');
        $response->assertSeeText('Service record request complete');

    }

}
