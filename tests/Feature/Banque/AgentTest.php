<?php

namespace Tests\Feature\Banque;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_afficher_agents()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/agents');

        $response->assertStatus(200);
    }
}