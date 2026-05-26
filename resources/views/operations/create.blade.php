
<style>
    /* Body background */
    body {
        background: linear-gradient(to right, #7f00ff, #e0c9f0ff);
        font-family: 'Segoe UI', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Form container */
    .bank-form {
        background: #ffffff;
        max-width: 450px;
        width: 100%;
        padding: 2rem;
        border-radius: 2rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .bank-form:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    /* Form heading */
    .bank-form h1 {
        text-align: center;
        color: #003366;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    /* Labels */
    .bank-form label {
        display: block;
        font-weight: bold;
        color: #003366;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Inputs and selects */
    .bank-form input,
    .bank-form select,
    .bank-form textarea {
        width: 90%;
        padding: 0.75rem 1rem;
        padding-left: 2.5rem;
        border-radius: 1rem;
        border: 1px solid #b0c4de;
        outline: none;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .bank-form input:focus,
    .bank-form select:focus,
    .bank-form textarea:focus {
        border-color: #003366;
        box-shadow: 0 0 8px rgba(0, 51, 102, 0.5);
    }

    /* Icons inside inputs */
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #808080;
        pointer-events: none;
    }

    /* Submit button */
    .bank-form button {
        width: 100%;
        padding: 0.75rem;
        border-radius: 1rem;
        border: none;
        font-weight: bold;
        font-size: 1rem;
        background: linear-gradient(90deg, #562d98ff, #a7a9e8ff);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .bank-form button:hover {
        background: linear-gradient(90deg, #8556d1ff, #e8db4d85);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Error message */
    .error-msg {
        background: #ffdddd;
        color: #a33;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        margin-bottom: 1rem;
        border: 1px solid #f5c2c2;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .bank-btn {
        width: 100%;
        padding: 0.75rem;
        border-radius: 1rem;
        border: none;
        font-weight: bold;
        font-size: 1rem;
        background: linear-gradient(90deg, #562d98ff, #a7a9e8ff);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .bank-btn:hover {
        background: linear-gradient(90deg, #8556d1ff, #e8db4d85);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .page-wrapper {
        min-height: calc(100vh - 80px);
        /* باش ما يضربش مع navbar */
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to right, #7f00ff, #e0c9f0ff);
        padding: 2rem;
    }
</style>

@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="bank-form">
        <h1>🏦 {{ ucfirst($type) }}</h1>
        @if(session('error'))
        <div class="error-msg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" style="width:20px;height:20px;">
                <path fill-rule="evenodd" d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zm-8-4a1 1 0 00-1 1v4a1 1 0 102 0V7a1 1 0 00-1-1zm0 8a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('operations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <!-- Compte -->
            <div style="position: relative; margin-bottom:1rem;">
                <label>🏦 Compte:</label>
                <select name="account_id" required>
                    @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">{{ $acc->nom }} - {{ $acc->numero_compte }} ({{ $acc->type }})</option>
                    @endforeach
                </select>
            </div>
            <!-- Compte Destination -->
            @if($type == 'virement')
            <div style="position: relative; margin-bottom:1rem;">
                <label>➡️ Compte Destination:</label>

                <select name="to_account_id" required>
                    @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">{{ $acc->nom }} - {{ $acc->numero_compte }} ({{ $acc->type }})</option>
                    @endforeach
                </select>
            </div>
            @endif
            <!-- Montant -->
            <div style="position: relative; margin-bottom:1rem;">
                <label>💰 Montant:</label>
                <input type="number" name="montant" placeholder="0.00" required>
            </div>
            <!-- Description -->
            <div style="position: relative; margin-bottom:1rem;">
                <label>📝 Description:</label>
                <textarea name="description" rows="3" placeholder="Optional"></textarea>
            </div>
            <button type="submit">Valider</button>
            <a href="{{ route('dashboard') }}" class="bank-btn">
                Quitter
            </a>
        </form>
    </div>
</div>
@endsection