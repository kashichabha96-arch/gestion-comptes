<?php
namespace App\Http\Controllers;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
public function index()
{
    $agents = Agent::all();
    return view('agents.index', compact('agents'));
}
public function create()
{
    return view('agents.create');
}
  public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'date_naissance' => 'nullable|date',
        'adresse' => 'nullable',
        'email' => 'required|email',
        'telephone' => 'nullable',
        'agence' => 'nullable',
    ]);

    Agent::create($request->all());
    return redirect()->route('agents.index')->with('success', 'Agent ajouté');
}
  public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }
    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $agent->id,
            'telephone' => 'nullable|string|max:20',
            'agence' => 'nullable|string|max:255',
        ]);

        $agent->update($request->all());

        return redirect()->route('agents.index')
            ->with('success', 'Utilisateur modifié avec succès ✅');
    }
    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')
            ->with('success', 'Utilisateur supprimé avec succès ❌');
    }
}