<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeadlineApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_headline(): void
    {
        $response = $this->get('/api/headline');
       // dd($response->decodeResponseJson());

        $response->assertStatus(200)->assertJsonStructure(['data'=>[['id', 'uuid','title','cover']]]);
    }
}
