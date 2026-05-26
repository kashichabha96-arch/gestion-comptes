<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Card;
use App\Models\Client;
use App\Models\Agent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDinar = Account::where('type', 'dinar')->count();
        $totalDevise = Account::where('type', 'devise')->count();
        $totalCards = Card::count();
        $totalClients = Client::count();   
        $totalAgents = Agent::count();

        return view('dashboard', compact(
            'totalDinar',
            'totalDevise',
            'totalCards',
            'totalClients',
            'totalAgents',
        ));
    }
}
