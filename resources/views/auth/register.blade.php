<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - EBOND</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            padding: 2rem;
        }
        
        .register-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .register-left {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .register-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .basketball-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            animation: bounce 2s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .basketball-icon i {
            font-size: 4rem;
            color: white;
        }
        
        .register-left h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .register-left p {
            font-size: 1.125rem;
            opacity: 0.9;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .register-right {
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .register-header {
            margin-bottom: 2rem;
        }
        
        .register-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .register-header p {
            color: #64748b;
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .form-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .btn-register {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        
        .login-link a:hover {
            color: #1e40af;
            text-decoration: underline;
        }
        
        .back-home {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }
        
        .back-home a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s;
        }
        
        .back-home a:hover {
            color: #2563eb;
        }
        
        @media (max-width: 968px) {
            .register-wrapper {
                grid-template-columns: 1fr;
            }
            
            .register-left {
                padding: 3rem 2rem;
            }
            
            .register-right {
                padding: 3rem 2rem;
            }
        }
        
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-wrapper">
            <!-- Left Side - Branding -->
            <div class="register-left">
                <div class="basketball-icon">
                    <i class="fas fa-basketball-ball"></i>
                </div>
                <h1>EBOND</h1>
                <p>École de Basket<br>Rejoignez notre communauté</p>
            </div>
            
            <!-- Right Side - Register Form -->
            <div class="register-right">
                <div class="register-header">
                    <h2>Créer un compte</h2>
                    <p>Inscrivez-vous pour accéder à toutes les fonctionnalités</p>
                </div>
                
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user" style="margin-right: 0.5rem; color: #2563eb;"></i>
                            Nom complet
                        </label>
                        <input 
                            id="name" 
                            class="form-input" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Votre nom complet"
                        />
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope" style="margin-right: 0.5rem; color: #2563eb;"></i>
                            Adresse Email
                        </label>
                        <input 
                            id="email" 
                            class="form-input" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="username"
                            placeholder="votre@email.com"
                        />
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock" style="margin-right: 0.5rem; color: #2563eb;"></i>
                            Mot de passe
                        </label>
                        <input 
                            id="password" 
                            class="form-input"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <small style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem; display: block;">
                            Minimum 8 caractères
                        </small>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock" style="margin-right: 0.5rem; color: #2563eb;"></i>
                            Confirmer le mot de passe
                        </label>
                        <input 
                            id="password_confirmation" 
                            class="form-input"
                            type="password"
                            name="password_confirmation"
                            required 
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire
                    </button>
                </form>
                
                <!-- Login Link -->
                <div class="login-link">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Déjà un compte ? Connectez-vous
                    </a>
                </div>
                
                <!-- Back Home -->
                <div class="back-home">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
