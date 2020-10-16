<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeathServiceTest extends TestCase
{
    public function setUp(): void
    {
        //Session::start();
        //$this->startSession();
        parent::setUp();
    }

    /**
     * @test
     */
    public function a_user_can_see_the_death_in_service_form()
    {
        $response = $this->get('/service/death-in-service', ['HTTP_REFERER' => 'testing']);
        $response->assertStatus(200);
        $response->assertSeeText('Did they die in service?');
        $response->assertSeeText('Continue');
    }

    /**
     * @test
     */
    public function a_user_must_make_a_choice()
    {
        $postData = [];
        $this->get('/service/death-in-service', ['HTTP_REFERER' => 'testing']);
        $response = $this->post('/service/death-in-service', $postData);
        $response->assertRedirect('/service/death-in-service');
        $response->assertSessionHasErrors(['death']);
    }


    /**
     * @test
     */
    public function a_user_can_save_their_death_in_service_choice()
    {
        $postData = [
            'death' => 'Yes'
        ];

        $response = $this->post('/service/death-in-service', $postData);
        $response->assertStatus(302);
        $response->assertRedirect('/essential-information');
        $response->assertSessionHas('death_in_service.death', $postData['death']);
    }
}
