<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'prenom' => fake()->name(),
            'telephone' => fake()->phoneNumber(),
            'numero_compte' => fake()->unique()->numerify('############'),
            'type' => 'dinar',
            'solde' => fake()->numberBetween(1000, 50000),
        ];
    }
}