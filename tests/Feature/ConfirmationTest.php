<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfirmationTest extends TestCase
{
    /**
     * @test
     */
    public function testExample()
    {
        $response = $this->withSession(['service' => 'Royal Navy / Royal Marines'])->get('/confirmation');
        $response->assertStatus(200);
    }
}
