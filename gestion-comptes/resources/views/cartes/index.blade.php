@extends('layouts.app')
@section('content')
<div class="bg-gray-100 min-h-screen p-6 font-sans">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 flex items-center gap-3 animate__animated animate__fadeInDown">
        <span>💳</span>
        <span>Liste des Cartes</span>
    </h1>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded shadow mb-6 animate__animated animate__fadeInDown">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto rounded-xl shadow-lg bg-white">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white">
                <tr>
                    <th class="py-4 px-4 text-left">ID</th>
                    <th class="py-4 px-4 text-left">Type</th>
                    <th class="py-4 px-4 text-left">Nom</th>
                    <th class="py-4 px-4 text-left">Prénom</th>
                    <th class="py-4 px-4 text-left">Numéro Carte</th>
                    <th class="py-4 px-4 text-left">Exp</th>
                    <th class="py-4 px-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cartes as $carte)
                <tr class="border-b hover:bg-gray-50 animate__animated animate__fadeInUp">
                    <td class="py-3 px-4">{{ $carte->id }}</td>
                    <td class="py-3 px-4 font-semibold capitalize">{{ $carte->type_carte }}</td>
                    <td class="py-3 px-4">{{ $carte->nom }}</td>
                    <td class="py-3 px-4">{{ $carte->prenom }}</td>
                    <td class="py-3 px-4 tracking-widest">
                        **** **** **** {{ substr($carte->num_carte, -4) }}
                    </td>
                    <td class="py-3 px-4">{{ $carte->date_expiration }}</td>

                    <!-- Actions -->
                    <td class="py-3 px-4 space-x-2 flex justify-center">
                        <a href="{{ route('cartes.edit', $carte->id) }}"
                            class="flex items-center space-x-2 bg-yellow-400 hover:bg-yellow-500 active:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-lg transition-all duration-300 animate__animated animate__pulse">
                            <span>✏️</span>
                            <span>Modifier</span>
                        </a>

                        <form action="{{ route('cartes.destroy', $carte->id) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de supprimer cette carte ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center space-x-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-bold py-2 px-4 rounded-xl shadow-lg transition-all duration-300 animate__animated animate__pulse">
                                <span>🗑️</span>
                                <span>Supprimer</span>
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-10 flex justify-between">
        <a href="{{ route('cartes.create') }}"
            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            ⬅️ Retour
        </a>

        <a href="{{ route('dashboard') }}"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            🏠 Dashboard
        </a>
    </div>
</div>
@endsection
