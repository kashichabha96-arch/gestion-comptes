@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-6 font-sans">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 flex items-center gap-3">
        ✏️ Modifier Carte
    </h1>

    <form action="{{ route('cartes.update', $carte->id) }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700">Type Carte</label>
                <select name="type_carte" class="w-full border rounded p-2">
                    <option value="Visa" {{ $carte->type_carte == 'Visa' ? 'selected' : '' }}>Visa</option>
                    <option value="MasterCard" {{ $carte->type_carte == 'MasterCard' ? 'selected' : '' }}>MasterCard</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="nom" value="{{ $carte->nom }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-gray-700">Prénom</label>
                <input type="text" name="prenom" value="{{ $carte->prenom }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-gray-700">Numéro Carte</label>
                <input type="text" name="num_carte" value="{{ $carte->num_carte }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-gray-700">Date Expiration</label>
                <input type="month" name="date_expiration" value="{{ $carte->date_expiration }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-gray-700">Compte</label>
                <select name="account_id" class="w-full border rounded p-2">
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}" {{ $carte->account_id == $acc->id ? 'selected' : '' }}>
                            {{ $acc->numero_compte }} - {{ $acc->nom }} {{ $acc->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
         
            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-6 rounded-2xl transition-all">
                Modifier
            </button>

          
            <a href="{{ route('cartes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-2xl transition-all">
                Retour
            </a>
        </div>
    </form>
</div>
@endsection
