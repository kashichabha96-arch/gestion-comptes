<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
@extends('layouts.app')
@section('content')
<div class="dashboard-bg">
    <div class="form-box animate__animated animate__fadeInUp">
        <h2 class="form-title animate__animated animate__zoomIn">
            <span class="form-icon animate__animated animate__heartBeat animate__infinite">
                <i class="fa-solid fa-credit-card"></i>
            </span>
            Créer Cartes
        </h2>
        <!-- Success Message -->
        @if(session('success'))
        <div class="success-msg">
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="error-msg">
            <ul>
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('cartes.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-credit-card"></i></span>
                <select class="w-full" name="type_carte" required>
                    <option value="" selected disabled>Choisir un type de carte</option>
                    <option value="visa">Carte Visa</option>
                    <option value="bancaire">Carte Bancaire</option>
                </select>
            </div>
            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="nom" placeholder="Nom" required>
            </div>

            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-user-tie"></i></span>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-building-columns"></i></span>
                <select name="account_id" required>
                    <option disabled selected>Choisir un compte</option>
                    @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">
                        {{ $acc->numero_compte }} | {{ $acc->nom }} {{ $acc->prenom }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-hashtag"></i></span>
                <input type="text" name="num_carte" placeholder="Numéro Carte" required>
            </div>
            <div class="input-group">
                <span class="input-icon"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="month" name="date_expiration" required>
            </div>
            <button type="submit" class="submit-btn">
                Créer Carte
            </button>
            <a href="{{ route('cartes.index') }}" class="list-btn">
                <i class="fa-solid fa-list"></i> Liste des cartes
            </a>
            <a href="{{ route('dashboard') }}" class="back-btn">
                Quitter
            </a>
        </form>
    </div>
</div>
<style>
    .dashboard-bg {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(to right, #7f00ff, #e0c9f0ff);
        padding: 20px;
    }

    .form-box {
        width: 100%;
        max-width: 500px;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    .form-title {
        font-size: 2.5rem;
        color: #6b21a8;
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .input-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        border: 2px solid #d8b4fe;
        border-radius: 12px;
        padding: 8px 12px;
        background: #f5f3ff;
        transition: all 0.3s ease;
    }

    .input-group:hover {
        border-color: #8b5cf6;
        box-shadow: 0 5px 12px rgba(139, 92, 246, 0.2);
    }

    .input-icon {
        font-size: 1.5rem;
        margin-right: 8px;
        color: #7c3aed;
    }

    .input-group input,
    .input-group select {
        border: none;
        outline: none;
        flex: 1;
        font-size: 1rem;
        background: transparent;
        color: #4c1d95;
        padding: 8px;
        border-radius: 10px;
    }

    .submit-btn {
        width: 100%;
        background: #7c3aed;
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        padding: 12px;
        border-radius: 18px;
        border: none;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(124, 58, 237, 0.3);
    }

    /* Success Message Style */
    .success-msg {
        background: #d1fae5;
        color: #065f46;
        padding: 10px 15px;
        border-radius: 12px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .error-msg {
        background: #fee2e2;
        color: #b91c1c;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .back-btn {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 10px;
        padding: 12px;
        border-radius: 18px;
        border: 2px solid #7c3aed;
        color: #7e3eeb;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: #7c3aed;
        color: #fff;
    }

    .list-btn {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 10px;
        padding: 12px;
        border-radius: 18px;
        border: 2px solid #7c3aed;
        color: #7c3aed;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .list-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
    
</style>

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Input Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

<script>
    $(document).ready(function() {
        $('input[name="num_carte"]').inputmask("9999 9999 9999 9999");


    });
</script>

@endsection