<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{
    // 📋 Liste des comptes (dinar / devise)
    public function index(Request $request)
{
    $type = $request->query('type');

    if (!in_array($type, ['dinar', 'devise'])) {
        return redirect()->route('accounts.index', ['type' => 'dinar']);
    }

    // Nous répondons aux comptes en fonction de leur type.
    $accounts = Account::where('type', $type)->get();

    return view('accounts.index', compact('accounts', 'type'));
}


    // ➕ Form création (dinar / devise)
    public function create($type)
    {
        if (!in_array($type, ['dinar', 'devise'])) {
            abort(404);
        }       
        $clients = Client::all();
        return view('accounts.create', compact('clients', 'type'));
    }

    // 💾 Enregistrer compte
    public function store(Request $request)
    {
        $request->validate([
          
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
          //  'num_compte' => 'required|unique:accounts,numero_compte',//
            'numero_compte' => 'unique:accounts,numero_compte',
            'type' => 'required|in:dinar,devise',
            'solde' => 'required|numeric|min:0',
        ],['num_compte.unique' => '⚠️ Numéro de compte déjà utilisé. Veuillez vérifier.'
]);

        do {
            $numero_compte = mt_rand(1000000000, 9999999999);
        } while (Account::where('numero_compte', $numero_compte)->exists());

        Account::create([
            
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'numero_compte' => $numero_compte,
            'type' => $request->type,
            'solde' => $request->solde,
        ]);

         return redirect()->route('accounts.index', [
        'type' => $request->type
    ])->with('success', 'Compte créé avec succès 🎉');

    }
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    // 🔄 Update
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'type' => 'required|in:dinar,devise',
            'solde' => 'required|numeric|min:0',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index', ['type' => $account->type])
            ->with('success', 'Compte modifié avec succès!');
    }

    // 🗑️ Supprimer
    public function destroy(Account $account)
    {
        $type = $account->type;
        $account->delete();

        return redirect()->route('accounts.index', ['type' => $type])
            ->with('success', 'Compte supprimé avec succès!');
    }
}
