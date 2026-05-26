@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-8 bg-white rounded-xl shadow-xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Modifier Client</h2>

    <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="nom" value="{{ $client->nom }}" class="w-full p-3 border rounded-lg" required>
        <input type="text" name="prenom" value="{{ $client->prenom }}" class="w-full p-3 border rounded-lg">
        <input type="date" name="date_naissance" value="{{ $client->date_naissance }}" class="w-full p-3 border rounded-lg">
        <input type="text" name="adresse" value="{{ $client->adresse }}" class="w-full p-3 border rounded-lg">
        <input type="email" name="email" value="{{ $client->email }}" class="w-full p-3 border rounded-lg" required>
        <input type="tel" name="telephone" value="{{ $client->telephone }}" class="w-full p-3 border rounded-lg">

        <button type="submit" class="w-full bg-purple-700 text-white py-3 rounded-lg font-bold hover:bg-purple-600 transition-all">
            Enregistrer les modifications
        </button>
    </form>
</div>
@endsection
