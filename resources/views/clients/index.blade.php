<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion Clients</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gray-100 p-6 font-sans">

    <div class="max-w-7xl mx-auto">
        <!-- Titre -->
        <h1 class="text-4xl font-bold text-gray-800 mb-8 flex items-center space-x-3 animate__animated animate__fadeInDown">
            <span>👥</span>
            <span>Gestion des Clients</span>
        </h1>
        <!-- 🔽 BOUTONS -->
        <div class="mt-6 mb-8 flex justify-between items-center animate__animated animate__fadeIn">
            <!-- Ajouter Client -->
            <a href="{{ route('clients.create') }}"
                class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700
                  text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition">
                ➕ Ajouter Client
            </a>
            <!-- Quitter -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400
                  text-gray-800 font-bold py-3 px-6 rounded-2xl shadow-lg transition">
                ⬅️ Quitter
            </a>
        </div>
        <!-- Message success -->
        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded shadow mb-6 animate__animated animate__fadeInDown">
            {{ session('success') }}
        </div>
        @endif
        <!-- Tableau -->
        <div class="overflow-x-auto rounded-xl shadow-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Nom</th>
                        <th class="py-3 px-4 text-left">Prénom</th>
                        <th class="py-3 px-4 text-left">Date Naissance</th>
                        <th class="py-3 px-4 text-left">Adresse</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Téléphone</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr class="border-b hover:bg-gray-50 transition animate__animated animate__fadeInUp">
                        <td class="py-3 px-4 font-medium">{{ $client->nom }}</td>
                        <td class="py-3 px-4">{{ $client->prenom ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $client->date_naissance ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $client->adresse ?? '-' }}</td>
                        <td class="py-3 px-4 text-blue-600">{{ $client->email }}</td>
                        <td class="py-3 px-4">{{ $client->telephone ?? '-' }}</td>
                        <!-- Actions -->
                        <td class="py-3 px-4 space-x-2 flex justify-center">
                            <a href="{{ route('clients.edit', $client->id) }}"
                                class="flex items-center space-x-2 bg-yellow-400 hover:bg-yellow-500 active:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-lg transition-all duration-300 animate__animated animate__pulse">
                                <span>✏️</span>
                                <span>Modifier</span>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de supprimer ce client ?');"
                                class="inline-block">
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

    </div>

</body>

</html>