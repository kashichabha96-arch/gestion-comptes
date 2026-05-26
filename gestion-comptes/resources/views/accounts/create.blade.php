@extends('layouts.app')
@section('content')
<div class="dashboard-bg">

    <div class="form-box animate__animated animate__fadeInUp">
        <h2 class="form-title animate__animated animate__zoomIn">
            <span class="form-icon animate__animated animate__heartBeat animate__infinite">💳</span>
            <span class="title-text">
                Créer Compte <span class="type-pill">{{ strtoupper($type) }}</span>
            </span>
        </h2>


        <form action="{{ route('accounts.store') }}" method="POST" class="form-fields">
            @csrf

            @error('num_compte')
    <div style="color:#d90429; font-weight:600; margin-bottom:6px;">
         {{ $message }}
    </div>
@enderror
            <div class="input-group">
                <span class="input-icon">🙍‍♂️</span>
                <input type="text" name="nom" placeholder="Nom" required>
            </div>

            <div class="input-group">
                <span class="input-icon">🙍‍♀️</span>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>

            <div class="input-group">
                <span class="input-icon">📞</span>
                <input type="tel" name="telephone" placeholder="Téléphone" required>
            </div>

            <div class="input-group">
                <span class="input-icon">🔢</span>
                <input type="text" name="num_compte" placeholder="Numéro de Compte" value="{{ old('num_compte') }}" required>
            </div>
          

            <div class="input-group">
                <span class="input-icon">💰</span>
                <input type="number" name="solde" placeholder="Solde Initial" required>
            </div>
           
            <div class="input-group">
                <span class="input-icon">📁</span>
                <select name="type" required>
                    <option value="dinar" selected>Dinar</option>
                    <option value="devise">Devise</option>
                </select>
            </div>

            <input type="hidden" name="type" value="{{ $type }}">
            <button type="submit" class="submit-btn">
                Créer Compte
            </button>

            <a href="{{ route('accounts.index', ['type' => $type]) }}" class="list-btn">
                📋 Voir la liste des comptes
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
        /* أصغر من قبل */
        background: #fff;
        padding: 30px;
        /* أقل شوية */
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    .form-title {
        font-size: 2.5rem;
        /* أصغر شوية */
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
        /* أقل شوية */
        border: 2px solid #d8b4fe;
        border-radius: 12px;
        /* أصغر */
        padding: 8px 12px;
        /* أصغر */
        background: #f5f3ff;
        transition: all 0.3s ease;
    }

    .input-group:hover {
        border-color: #8b5cf6;
        box-shadow: 0 5px 12px rgba(139, 92, 246, 0.2);
    }

    .input-icon {
        font-size: 1.5rem;
        /* أصغر */
        margin-right: 8px;
        color: #7c3aed;
    }

    .input-group input,
    .input-group select {
        border: none;
        outline: none;
        flex: 1;
        font-size: 1rem;
        /* أصغر */
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
        /* أصغر */
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

    .list-btn {
        display: block;
        margin: 15px auto 0;
        background: #ede9fe;
        color: #7c3aed;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .list-btn:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
    }

    .back-btn {
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

    .back-btn:hover {
        background: #7c3aed;
        color: #fff;
    }

    .form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        /* مهم باش ما يخرجش */
    }

    .title-text {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        /* مهم */
    }

    .type-pill {
        font-size: 1rem;
        padding: 4px 10px;
        border-radius: 12px;
        background: #ede9fe;
        color: #7c3aed;
        font-weight: bold;
    }
</style>

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection