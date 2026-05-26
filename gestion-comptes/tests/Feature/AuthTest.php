<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function utilisateur_peut_voir_page_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('Connexion');
    }

    /** @test */
    public function utilisateur_peut_se_connecter_avec_identifiants_valides()
    {
        $user = User::factory()->create([
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'admin@gmail.com',
            'password' => '123456',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function connexion_echoue_avec_mauvais_mot_de_passe()
    {
        User::factory()->create([
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'admin@gmail.com',
            'password' => 'wrongpass',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function connexion_echoue_avec_email_inexistant()
    {
        $response = $this->post('/login', [
            'email'    => 'fake@gmail.com',
            'password' => '123456',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function connexion_echoue_si_champs_vides()
    {
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function utilisateur_peut_se_deconnecter()
    {
        $user =  User::factory()->create([
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
    ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /** @test */
    public function utilisateur_non_connecte_redirige_vers_login()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
