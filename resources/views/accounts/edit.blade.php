@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-8 bg-white rounded-xl shadow-xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Modifier Compte</h2>

    <form action="{{ route('accounts.update', $account->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="nom" value="{{ $account->nom }}" class="w-full p-3 border rounded-lg" required>
        <input type="text" name="prenom" value="{{ $account->prenom }}" class="w-full p-3 border rounded-lg" required>
        <input type="tel" name="telephone" value="{{ $account->telephone }}" class="w-full p-3 border rounded-lg" required>
        <input type="number" name="solde" value="{{ $account->solde }}" class="w-full p-3 border rounded-lg" required>
        <select name="type" class="w-full p-3 border rounded-lg" required>
            <option value="dinar" {{ $account->type=='dinar' ? 'selected' : '' }}>Dinar</option>
            <option value="devise" {{ $account->type=='devise' ? 'selected' : '' }}>Devise</option>
        </select>

        <button type="submit" class="w-full bg-purple-700 text-white py-3 rounded-lg font-bold hover:bg-purple-600 transition-all">
            Enregistrer les modifications
        </button>
    </form>
</div>
@endsection
