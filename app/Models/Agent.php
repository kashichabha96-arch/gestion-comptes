<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'date_naissance',
        'adresse', 'email', 'telephone', 'agence'
    ];    
public function index()
{
    $totalagents = Agent::count();

    return view('dashboard', compact('totalagents'));
}

}

