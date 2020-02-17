<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentationTest extends TestCase
{
    public function setUp() : void
    {
        //Session::start();
        //$this->startSession();
        parent::setUp();
    }

    /**
     * @test
     */
    public function testVerificationUpload()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/verify', ['certificate' => $file]);

        // Assert the file was stored...
        Storage::disk('local')->assertExists('verification/' . $file->hashName());
    }


}
