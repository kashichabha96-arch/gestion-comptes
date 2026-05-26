<?php

namespace Tests\Feature\Banque;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_afficher_clients()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/clients');

        $response->assertStatus(200);
    }

    public function test_peut_creer_client()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/clients', [
                            'nom' => 'Ali',
                            'prenom' => 'Ahmed',
                            'email' => 'ali@test.com',
                            'telephone' => '0555555555'
                         ]);

        $response->assertStatus(302);
    }
}