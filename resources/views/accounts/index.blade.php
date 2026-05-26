<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Comptes</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gray-100 p-6 font-sans">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 flex items-center space-x-3 animate__animated animate__fadeInDown">
            <span>💼</span>
            <span>Liste des Comptes {{ isset($type) ? strtoupper($type) : 'Tous' }}</span>
        </h1>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded shadow mb-6 animate__animated animate__fadeInDown">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Prénom</th>
                    <th class="py-3 px-4 text-left">Téléphone</th>
                    <th class="py-3 px-4 text-left">Numéro Compte</th>
                    <th class="py-3 px-4 text-left">Type</th>
                    <th class="py-3 px-4 text-left">Solde</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $acc)
                <tr class="border-b hover:bg-gray-50 animate__animated animate__fadeInUp animate__delay-{{ $loop->index + 1 }}s">
                    <td class="py-3 px-4">{{ $acc->id }}</td>
                    <td class="py-3 px-4 font-medium">{{ $acc->nom }}</td>
                    <td class="py-3 px-4">{{ $acc->prenom }}</td>
                    <td class="py-3 px-4">{{ $acc->telephone }}</td>
                    <td class="py-3 px-4">{{ $acc->numero_compte }}</td>
                    <td class="py-3 px-4 capitalize">{{ $acc->type }}</td>
                    <td class="py-3 px-4 font-semibold text-blue-600">{{ number_format($acc->solde, 2, ',', ' ') }} DZD</td>
                    <td class="py-3 px-4 space-x-2 flex justify-center">
                        <a href="{{ route('accounts.edit', $acc->id) }}"
                            class="flex items-center space-x-2 bg-yellow-400 hover:bg-yellow-500 active:bg-yellow-600 text-white font-bold py-2 px-4 rounded-xl shadow-lg transition-all duration-300 animate__animated animate__pulse">
                            <span>✏️</span>
                            <span>Modifier</span>
                        </a>
                        <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de supprimer ce compte ?');" class="inline-block">
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
        </table>
    </div>

    <!-- 🔽 BOUTONS -->
    <div class="mt-10 flex justify-between items-center">
        <a href="{{ route('accounts.create', $type) }}"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700
              text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            ⬅️ Retour
        </a>

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-2 bg-gray-300 hover:bg-gray-400
              text-gray-800 font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            🏠 Dashboard
        </a>
    </div>

    </div>
    </div>
</body>
</html>