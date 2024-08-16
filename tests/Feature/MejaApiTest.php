<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MejaApiTest extends TestCase
{
    public $endPointURL='/api/meja';

    /**
     * A basic feature test example.
     */
    /**
     * A basic feature test example.
     */
    public function test_get_all_meja(): void
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->getJson($this->endPointURL);
       // dd($response->decodeResponseJson());

        $response->assertStatus(200);
    }
}
