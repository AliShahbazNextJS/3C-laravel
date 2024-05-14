<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUserCreation()
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'Ali Ahmad',
            'email' => 'john111147@example.com',
        ]);
        
        // Assert that the user was created successfully
        $this->assertInstanceOf(User::class, $user);

        // Assert that the user's attributes match the provided values
        $this->assertEquals('Ali Ahmad', $user->name);
        $this->assertEquals('john111147@example.com', $user->email);

        // Assert that the user exists in the database
        $this->assertDatabaseHas('users', [
            'name' => 'Ali Ahmad',
            'email' => 'john111147@example.com',
        ]);
    }
    public function it_can_delete_user()
    {
        // Create a user
        $user = User::factory()->create();

        // Call the delete endpoint
        $response = $this->delete(route('users.destroy', ['id' => $user->id]));

        // Assert the user was deleted
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // Assert the response is a redirect to the index page
        $response->assertRedirect(route('users.index'));

        // Assert a success message
        $response->assertSessionHas('success', 'User deleted successfully');
    }
}
