<?php

namespace Tests\Feature\Banque;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperationTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_afficher_operations()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/operations/historique');

        $response->assertStatus(200);
    }
}