<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Client</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#7f00ff] to-[#e0c9f0ff] p-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6 flex items-center gap-2">
            ➕ Ajouter Client
        </h1>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Nom</label>
                <input type="text" name="nom" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="w-full border rounded p-2" value="{{ old('date_naissance') }}">
            </div>
            <div>
                <label>Adresse</label>
                <input type="text" name="adresse" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Téléphone</label>
                <input type="text" name="telephone" class="w-full border rounded p-2">
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('clients.index') }}"
                    class="bg-gray-300 px-6 py-2 rounded-lg">
                    ⬅️ Retour
                </a>
                <button type="submit"
                    class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:scale-105 transition transform duration-300 active:bg-purple-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enregistrer
                </button>
              </div>
            </form>
           </div>
         </body>
         </html>