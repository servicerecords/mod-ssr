<?php

namespace Tests\Feature;

use Tests\TestCase;

class RelationshipTest extends TestCase
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
    public function user_can_see_relationship_form()
    {
        $response = $this->get('/your-details/relationship');

        $response->assertStatus(200);
        $response->assertSeeText('How are you related to the serviceperson?');
    }

    /**
     * @test
     */
    public function user_must_submit_a_relationship()
    {
        $stub = [
            'relationship' => ''
        ];

        $response = $this->post('/your-details/relationship', $stub);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['relationship']);

    }

    /**
     * @test
     */
    public function user_can_submit_and_store_a_relationship()
    {
        $stub = [
            'relationship' => 'Mother/Father',
            'next_of_kin' => 'Yes'
        ];

        $response = $this->post('/your-details/relationship', $stub);
        //$response->dump();
        $response->assertSessionHas(['your_details.relationship']);
        $response->assertStatus(302);

        //$response->assertRedirect('/check-your-answers');
    }

}
