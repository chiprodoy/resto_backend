<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

use function Laravel\Prompts\password;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_show_validation_error_when_both_fields_empty()
    {
        $response = $this->json('POST', 'api/login', [
            'email' => '',
            'password' => ''
        ]);
        //dd($response->decodeResponseJson());
        $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_show_validation_error_on_email_when_credential_donot_match()
    {
        $response = $this->json('POST', 'api/login', [
            'email' => 'test@test.com',
            'password' => 'abcdabcd'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_return_user_and_access_token_after_successful_login()
    {
        $response = $this->json('POST', 'api/login', [
            'email' =>'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['user', 'access_token']);
    }

    public function test_non_authenticated_user_cannot_get_user_details()
    {
        $response = $this->json('GET', 'api/user');

        $response->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_user_can_get_user_details()
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->json('GET', 'api/user');

        $response->assertStatus(200)
            ->assertJsonStructure(['name', 'email']);
    }

    public function test_non_authenticated_user_cannot_logout()
    {
        $response = $this->json('POST', 'api/logout', []);

        $response->assertStatus(401)
            ->assertSee('Unauthenticated');;
    }

    public function test_authenticated_user_can_logout()
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->json('POST', 'api/logout', []);

        $response->assertStatus(200);
    }

    public function test_return_validation_error_when_email_doenot_exist()
    {
        $response = $this->json('POST', route('password.email'), ['email' => 'invalid@email.com']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_send_password_reset_link_if_email_exists()
    {
        $user = User::first();
        $response = $this->json('POST', route('password.email'), ['email' => $user->email]);
        $response->assertStatus(200)
            ->assertJsonStructure(['status']);
    }

    public function test_reset_password_success()
    {
        $user = User::first();
        $token = Password::broker()->createToken($user);
        $new_password = 'testpassword';

        $response = $this->json('POST', route('password.store'), [
            'token' => $token,
            'email' => $user->email,
            'password' => $new_password,
            'password_confirmation' => $new_password
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['status']);
    }
}
