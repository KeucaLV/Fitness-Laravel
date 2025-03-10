<?php

namespace Tests\Feature;

use App\Models\Lietotajs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; // Import TestCase to extend it

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase; // Use RefreshDatabase to reset the database after each test

    /** @test */
    public function it_registers_a_user_successfully()
    {
        $response = $this->postJson('/api/register', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'password' => 'secret123',
        ]);

        // Assert the response status and structure
        $response->assertStatus(201)
            ->assertJson(['message' => 'Registration successful']);

        // Check if the user was created in the database
        $this->assertDatabaseHas('lietotajs', [
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
        ]);
    }

    /** @test */
    public function it_fails_to_register_a_user_with_existing_email()
    {
        // Create a user first
        Lietotajs::create([
            'firstname' => 'Existing',
            'lastname' => 'User',
            'email' => 'john.doe@example.com',
            'username' => 'existinguser',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->postJson('/api/register', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com', // Same email
            'username' => 'johndoe',
            'password' => 'secret123',
        ]);

        // Assert the response status and structure
        $response->assertStatus(422) // Unprocessable Entity
        ->assertJsonValidationErrors(['email']);
    }
}
