<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Operation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    // Créer un formulaire de processus
    public function create($type)
    {
        if (!in_array($type, ['versement', 'retrait', 'virement'])) {
            abort(404);
        }
        $accounts = Account::all();

        return view('operations.create', compact('type', 'accounts'));
    }

    //  Enregistrement 
    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'type' => 'required|in:versement,retrait,virement',
            'montant' => 'required|numeric|min:1',
            'to_account_id' => 'nullable|exists:accounts,id',
            'description' => 'nullable|string|max:255',
        ]);
        $account = Account::find($request->account_id);
        if($request->type == 'versement') {
            $account->solde += $request->montant;
        } elseif($request->type == 'retrait') {
            if($account->solde < $request->montant) {
                return back()->with('error', 'solde insuffisant');
            }
            $account->solde -= $request->montant;
        } elseif($request->type == 'virement') {
            $toAccount = Account::find($request->to_account_id);

            if($request->account_id == $request->to_account_id) {
                return back()->with('error','Les virements vers le même compte ne sont pas possibles.');
            }

            if($account->solde < $request->montant) {
                return back()->with('error', 'solde insuffisant');
            }
            $account->solde -= $request->montant;
            $toAccount->solde += $request->montant;
            $toAccount->save();
        }
        $account->save();
        // Enregistrement 
        Operation::create([
            'account_id' => $request->account_id,
            'to_account_id' => $request->to_account_id,
            'type' => $request->type,
            'montant' => $request->montant,
            'description' => $request->description,
        ]);

        Notification::create([
    'user_id' => Auth::id(),
    'type' => 'operation',
    'message' => "L'opération a été un succès.: $request->montant DA",
]);
      // Rediriger vers l'historique avec un message de succès
        return redirect()->route('operations.historique')
                         ->with('success','l operation a ete avec succes!');
    }
   // Page Historique des opérations avec filtrage des comptes
    public function history(Request $request)
    {
        $accountId = $request->query('account_id');
        $operations = Operation::when($accountId, fn($q) => $q->where('account_id', $accountId))
                               ->orderBy('created_at','desc')
                               ->get();

        return view('operations.history', compact('operations','accountId'));
    }

  // Page d'historique de toutes les opérations
    public function historique()
    {
        $operations = Operation::with('account','toAccount')
            ->orderBy('created_at','desc')
            ->get();

        return view('operations.historique', compact('operations'));
    }
}
