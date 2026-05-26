<?php
namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Account;
class CarteController extends Controller
{
    public function create()
    {
        $accounts = Account::all();
        return view('cartes.create', compact('accounts'));
    }
    public function index()
    {
        $cartes = Card::orderBy('created_at', 'desc')->get();
        return view('cartes.index', compact('cartes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'type_carte' => 'required',
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'num_carte' => ['required', 'regex:/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/'],
            'date_expiration' => 'required',
            'account_id' => 'required|exists:accounts,id',
        ]);
        $num = str_replace(' ', '', $request->num_carte); // spaces
        Card::create([
            'type_carte' => $request->type_carte,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'num_carte' => $num,
            'date_expiration' => $request->date_expiration,
            'account_id' => $request->account_id,
        ]);
        return redirect()->route('cartes.create')->with('success', 'Carte créée avec succès 🎉!');
    }

    public function edit($id)
{
    $carte = Card::findOrFail($id);
    $accounts = Account::all();
    return view('cartes.edit', compact('carte', 'accounts'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'type_carte' => 'required',
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'num_carte' => ['required', 'regex:/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/'],
        'date_expiration' => 'required',
        'account_id' => 'required|exists:accounts,id',
    ]);

    $carte = Card::findOrFail($id);
    $carte->update([
        'type_carte' => $request->type_carte,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'num_carte' => str_replace(' ', '', $request->num_carte),
        'date_expiration' => $request->date_expiration,
        'account_id' => $request->account_id,
    ]);

    return redirect()->route('cartes.index')->with('success', 'Carte modifiée avec succès !');
}
public function destroy($id)
{
    $carte = Card::findOrFail($id);
    $carte->delete();

    return redirect()->route('cartes.index')->with('success', 'Carte supprimée avec succès !');
}

}
