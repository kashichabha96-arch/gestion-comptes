<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestion des Comptes</title>
    <style>
        /* Background Gradient */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3743acff, #c33764);

            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Login Box */
        .login-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 380px;
            text-align: center;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Logo */
        .logo {
            width: 80%;
            margin-bottom: 15 px;

            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-10px);
            }
        }

        /* Title */
        .login-box h2 {
            margin-bottom: 25px;
            color: #333;
        }

        /* Inputs */
        input[type="email"],
        input[type="password"] {
            width: 80%;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #c33764;
            box-shadow: 0 0 5px #c33764;
        }

        /* Button */
        button {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: #c33764;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1d2671;
        }

        /* Error Message */
        .error-msg {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <!-- Logo -->
        <img src="/images/logo.png" alt="Logo" class="logo">
        <h2>Connexion</h2> 

        <!-- Error Message -->
        @if(session('error'))
        <p class="error-msg">{{ session('error') }}</p>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>