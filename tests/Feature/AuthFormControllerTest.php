<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFormControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_show_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

   

    public function test_login_with_valid_credentials()
    {
        $password = 'secret123';
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => $password,
        ]);

        $response->assertRedirect('/books');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_with_invalid_credentials_fails()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('correct-password'),
        ]);

        // Dari halaman login
        $response = $this->from('/login')->post('/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    
}
