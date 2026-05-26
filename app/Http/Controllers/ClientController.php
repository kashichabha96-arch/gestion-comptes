<?php
namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }
    public function create()
    {
        return view('clients.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'nullable|string|max:20',
        ]);
         $data = $request->all();
        $data['date_naissance'] = $request->date_naissance ?: null;
        Client::create($data);
        return redirect()->route('clients.index')
            ->with('success', 'Client ajouté avec succès ✅');
    }
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'telephone' => 'nullable|string|max:20',
        ]);
        $client->update($request->all());
        return redirect()->route('clients.index')
            ->with('success', 'Client modifié avec succès ✅');
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès ❌');
    }
}
