<?php

namespace Tests\Feature\Banque;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarteTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_afficher_cartes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/cartes');

        $response->assertStatus(200);
    }
}