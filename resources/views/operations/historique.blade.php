<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Historique des opérations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📜 Historique des opérations</h1>
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-purple-500 text-white">
                <tr>
                    <th class="p-3">Date</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Compte</th>
                    <th class="p-3">Destination</th>
                    <th class="p-3">Montant</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $operation->description ?? '-' }}</td>
                @foreach($operations as $op)
                <tr class="border-b text-center">
                    <td class="p-2">{{ $op->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-2 capitalize">{{ $op->type }}</td>
                    <td class="p-2">{{ $op->account->numero_compte }}</td>
                    <td class="p-2">
                        {{ $op->toAccount ? $op->toAccount->numero_compte : '-' }}
                    </td>
                    <td class="p-2 font-bold">{{ number_format($op->montant,2) }} DZD</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- 🔽 BOUTONS -->
    <div class="mt-10 flex justify-between items-center">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700
              text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition">
            ⬅️ Retour
        </a>
    </div>
    </div>

</body>

</html>