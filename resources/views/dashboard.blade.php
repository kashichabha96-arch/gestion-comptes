<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Banque</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            background: #efedf1ff;
            color: #1f2937;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #f0f0ff, #6031be, #eedb9dff, #6031be, #a386dcff);
            background-size: 400% 400%;
            height: 100vh;
            padding: 5px;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
            position: fixed;
            color: white;
        }

        .sidebar h3 {
            margin-bottom: 30px;
            color: #1f2937;
            /* داكن شوي */
            letter-spacing: 1px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px;
            margin: 10px 0;
            text-decoration: none;
            color: #1f2937;
            /* داكن text */
            border-radius: 8px;
            transition: .3s;
            font-size: 15px;
            background: rgba(255, 255, 255, 0.8);
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar a:hover {
            background: #fcd34d;
            /* أصفر فاتح حيوي */
            color: #ab3de1ff;
            transform: translateX(5px);
        }

        /* ===== Content ===== */
        .content {
            width: 100%;
            padding: 40px;
            margin-left: 250px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 20px;
        }

        .box {
            padding: 25px;
            border-radius: 12px;
            background: #ffffff;
            font-size: 20px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            transition: .4s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            border-left: 6px solid #fcd34d;
            /* حد أصفر فاتح */
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .number {
            font-size: 36px;
            font-weight: bold;
            margin-top: 10px;
            color: #3b82f6;
            /* أزرق فاتح */
        }

        /* Chart Section */
        .chartBox {
            margin-top: 40px;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        @media(max-width:900px) {
            body {
                display: block;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }

            .stats {
                grid-template-columns: 1fr;
            }


        }

        .ops-dropdown {
            margin-left: 15px;
            margin-top: 5px;
            animation: slideDown 0.3s ease;
        }

        .hidden {
            display: none;
        }

        .ops-dropdown a {
            display: block;
            padding: 10px 15px;
            background: #ede9fe;
            color: #5b21b6;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .ops-dropdown a:hover {
            background: #ddd6fe;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .badge {
            background: #ff3b30;
            color: white;
            padding: 2px 7px;
            border-radius: 50%;
            font-size: 12px;
            position: relative;
            top: -10px;
            left: -10px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 12px;
            animation: pulseGlow 2.5s infinite;
        }

        @keyframes pulseGlow {
            0% {
                transform: scale(1);
                filter: drop-shadow(0 0 0 rgba(124, 58, 237, 0));
            }

            50% {
                transform: scale(1.1);
                filter: drop-shadow(0 0 12px rgba(124, 58, 237, 0.8));
            }

            100% {
                transform: scale(1);
                filter: drop-shadow(0 0 0 rgba(124, 58, 237, 0));
            }
        }

        .logo-text {
            margin-top: 5px;
            color: #1f2937;
            font-weight: bold;
            animation: textGlow 2.5s infinite;
        }

        @keyframes textGlow {
            0% {
                transform: scale(1);
                text-shadow: 0 0 0 rgba(124, 58, 237, 0);
            }

            50% {
                transform: scale(1.05);
                text-shadow: 0 0 12px rgba(124, 58, 237, 0.7);
            }

            100% {
                transform: scale(1);
                text-shadow: 0 0 0 rgba(124, 58, 237, 0);
            }
        }
    </style>
</head>

<body>
    @php
    $unreadCount = \App\Models\Notification::where('user_id', auth()->id()) 
    ->where('is_read', false)
    ->count();
    @endphp
    <!-- Top Horizontal Menu -->
    <div id="top-menu" style="position:fixed; top:0; left:260px; right:0; height:40px; background:#8e5af4ff; display:flex; justify-content:flex-end; align-items:center; padding:0 20px; z-index:100; box-shadow:0 2px 6px rgba(0,0,0,0.2);">
        <div class="notification-wrapper"
            style="position: relative; margin-right:20px;"
            onmouseenter="showNotif()"
            onmouseleave="hideNotif()">
            <!-- CLICK => page notifications -->
            <a href="{{ route('notifications.index') }}"
                style="color:white; font-size:20px; text-decoration:none;">
                <i class="fa-solid fa-bell"></i>
                @if($unreadCount > 0)
                <span class="badge">{{ $unreadCount }}</span>
                @endif
            </a>
            <!-- DROPDOWN -->
            <div id="notifDropdown"
                style="display:none; position:absolute; right:0; top:30px; width:320px;
                background:#fff; border-radius:10px;
                box-shadow:0 6px 18px rgba(0,0,0,0.2);
                overflow:hidden; z-index:999;">

                <div id="notifList" style="max-height:300px; overflow:auto;">
                    <p style="padding:10px; color:#777;">Loading...</p>
                </div>

                <div style="padding:10px; border-top:1px solid #eee; text-align:center;">
                    <a href="{{ route('notifications.index') }}"
                        style="text-decoration:none; color:#6b21a8; font-weight:600;">
                        Voir toutes les notifications
                    </a>
                </div>
            </div>
        </div>
        <button id="refreshBtn" style="background:none; border:none; color:white; margin-right:20px; cursor:pointer; font-size:16px;">
            <i class="fa-solid fa-arrows-rotate"></i> Actualiser
        </button>
        <form action="/logout" method="POST" style="margin:0;">
            @csrf
            <button type="submit" style="background:none; border:none; color:white; cursor:pointer; font-size:16px;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
    <!-- Script for dynamic behavior -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.addEventListener('click', () => {
                location.reload(); 
            });
        });
    </script>


    <div class="sidebar">
        <div class="logo" style="text-align:center; margin-bottom:20px;">
            <img class="logo-img" src="{{ asset('images/bdl1.png') }}" alt="Logo Banque" style="width:60px; height:60px; object-fit:contain; border-radius:12px;">
            <h4 class="logo-text" style="margin-top:5px; color:#1f2937; font-weight:bold;">BDL</h4>
        </div>
        <a href="{{ route('accounts.create', ['type' => 'dinar']) }}?type=dinar"><i class="fa-solid fa-coins"></i> Créer Compte Dinar</a>
        <a href="{{ route('accounts.create', ['type' => 'devise']) }}?type=devise"><i class="fa-solid fa-dollar-sign"></i> Créer Compte Devise</a>
        <a href="{{ route('cartes.create') }}"><i class="fa-solid fa-credit-card"></i> Créer Carte Bancaire</a>
        <!-- Button Operations -->
        <a href="javascript:void(0)" class="menu-btn" onclick="toggleOps()">
            <i class="fa-solid fa-building-columns"></i>
            Opérations Bancaires
            <i id="arrow" class="fa-solid fa-chevron-down float-right"></i>
        </a>
        <!-- LISTE -->
        <div id="opsMenu" class="ops-dropdown hidden">
            <a href="{{ route('operations.create', 'versement') }}"><i class="fa-solid fa-arrow-up"></i> Versement</a>
            <a href="{{ route('operations.create', 'retrait') }}"><i class="fa-solid fa-arrow-down"></i> Retrait</a>
            <a href="{{ route('operations.create', 'virement') }}"><i class="fa-solid fa-right-left"></i> Virement</a>
            <a href="{{ route('operations.historique') }}"><i class="block bg-purple-400 text-white p-3 rounded">
                    📜 Historique </i>
            </a>
        </div>
        <!-- Button Administration -->
        <a href="javascript:void(0)" class="menu-btn" onclick="toggleAdmin()">
            <i class="fa-solid fa-user-shield"></i>
            Administration
            <i id="adminArrow" class="fa-solid fa-chevron-down float-right"></i>
        </a>
        <!-- LISTE -->
        <div id="adminMenu" class="ops-dropdown hidden">
            <a href="{{ route('agents.index') }}">
                <i class="fa-solid fa-users-gear"></i> Gestion Utilisateurs
            </a>
            <a href="{{  route('clients.index') }}">
                <i class="fa-solid fa-user-tie"></i> Gestion Clients
            </a>
        </div>
    </div>

    <div class="content">
        <h1>📊 Tableau de Bord</h1>
        <div class="stats">
            <div class="box">
                Comptes Dinar
                <div class="number">{{ $totalDinar }}</div>
            </div>
            <div class="box">
                Comptes Devise
                <div class="number">{{ $totalDevise }}</div>
            </div>
            <div class="box">
                Cartes Bancaires
                <div class="number">{{ $totalCards }}</div>
            </div>

            <div class="box">
                Clients
                <div class="number">{{ $totalClients }}</div>
            </div>

            <div class="box">
                Utilisateurs
                <div class="number">{{ $totalAgents }}</div>
            </div>
        </div>

        <div class="chartBox">
            <canvas id="bankChart"></canvas>
        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // تمرير بيانات PHP للـ JS
            const dataValues = @json([$totalDinar, $totalDevise, $totalCards]);


            // Animate numbers
            ['dinar', 'devise', 'cards'].forEach((id, index) => {
                const el = document.getElementById(id);
                let start = 0;
                const end = dataValues[index];
                const duration = 1000;
                const stepTime = Math.max(Math.floor(duration / end), 1);
                const timer = setInterval(() => {
                    start++;
                    el.textContent = start;
                    if (start >= end) clearInterval(timer);
                }, stepTime);
            });

            // Chart
            const ctx = document.getElementById('bankChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Comptes Dinar', 'Comptes Devise', 'Cartes'],
                    datasets: [{
                        label: 'Statistiques',
                        data: dataValues,
                        backgroundColor: ['#60a5fa', '#fcd34d', '#34d399'],
                        borderRadius: 6,
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1500,
                        easing: 'easeOutBounce'
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        function toggleOps() {
            const menu = document.getElementById('opsMenu');
            const arrow = document.getElementById('arrow');

            menu.classList.toggle('hidden');

            // rotation arrow
            arrow.classList.toggle('rotate');
        }
    </script>

    <script>
        function toggleAdmin() {
            const menu = document.getElementById('adminMenu');
            const arrow = document.getElementById('adminArrow');

            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate');
        }
    </script>
    <script>
        let loaded = false;

        function showNotif() {
            const dropdown = document.getElementById('notifDropdown');
            dropdown.style.display = 'block';

            if (loaded) return;

            fetch("{{ route('notifications.dropdown') }}")
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('notifList');
                    list.innerHTML = '';

                    if (data.length === 0) {
                        list.innerHTML = '<p style="padding:10px;">Aucune notification</p>';
                    }

                    data.forEach(n => {
                        list.innerHTML += `
                    <div style="padding:10px; border-bottom:1px solid #eee;">
                        <p style="margin:0;">${n.message}</p>
                        <small style="color:#777;">${n.created_at}</small>
                    </div>
                `;
                    });

                    loaded = true;
                });
        }

        function hideNotif() {
            document.getElementById('notifDropdown').style.display = 'none';
        }
    </script>
</body>

</html>