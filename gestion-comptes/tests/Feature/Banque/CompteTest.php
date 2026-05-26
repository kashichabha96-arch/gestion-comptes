<?php
namespace Tests\Feature\Banque;

use App\Models\User;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompteTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_peut_creer_un_compte()
    {
        $response = $this->actingAs($this->user)->post('/accounts/store', [
            'nom' => 'Ali',
            'prenom' => 'Ahmed',
            'telephone' => '0550000000',
            'type' => 'dinar',
            'solde' => 10000,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('accounts', [
            'nom' => 'Ali',
            'prenom' => 'Ahmed',
            'type' => 'dinar',
            'solde' => 10000,
        ]);
    }

    public function test_peut_afficher_liste_comptes()
    {
        Account::factory()->count(3)->create();

        $response = $this->actingAs($this->user)
            ->get('/accounts?type=dinar');

        $response->assertStatus(200);
    }

    public function test_peut_supprimer_compte()
    {
        $account = Account::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete("/accounts/{$account->id}");

        $response->assertRedirect();

        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id
        ]);
    }
}