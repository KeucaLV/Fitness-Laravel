<?php

namespace Tests\Feature;

use App\Models\Lietotajs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_a_user_to_login_successfully()
    {
        // Create a user in the database
        $user = Lietotajs::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'password' => bcrypt('secret123'), // Store hashed password
        ]);

        // Attempt to log in
        $response = $this->postJson('/api/login', [
            'email' => 'john.doe@example.com',
            'password' => 'secret123',
        ]);

        // Assert the response contains an access token
        $response->assertStatus(200)
            ->assertJsonStructure(['access_token']);

        // Optionally, you can check if the access token is valid and associated with the user
        $this->assertNotEmpty($response['access_token']);
    }

    /** @test */
    public function it_fails_to_login_with_invalid_credentials()
    {
        // Attempt to log in with invalid credentials
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert the response for invalid credentials
        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid Credentials']);
    }

    /** @test */
    public function it_fails_to_login_with_incorrect_password()
    {
        // Create a user in the database
        $user = Lietotajs::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'password' => bcrypt('secret123'), // Store hashed password
        ]);

        // Attempt to log in with incorrect password
        $response = $this->postJson('/api/login', [
            'email' => 'john.doe@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert the response for invalid credentials
        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid Credentials']);
    }
}
