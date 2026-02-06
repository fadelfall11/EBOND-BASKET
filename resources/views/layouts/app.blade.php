<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EBOND - École de Basket') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #1e3a8a;
            --accent: #fbbf24;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px rgb(15 23 42 / 0.06);
            --shadow: 0 1px 3px rgb(15 23 42 / 0.08), 0 1px 2px rgb(15 23 42 / 0.04);
            --shadow-md: 0 8px 20px rgb(15 23 42 / 0.10);
            --shadow-lg: 0 16px 40px rgb(15 23 42 / 0.12);
            --shadow-xl: 0 24px 60px rgb(15 23 42 / 0.14);
            --shadow-2xl: 0 40px 90px rgb(15 23 42 / 0.18);
            --radius-sm: 12px;
            --radius-md: 16px;
            --radius-lg: 20px;
            --ring: 0 0 0 4px rgb(37 99 235 / 0.18);
        }
        
        [x-cloak] {
            display: none !important;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--gray-900);
            background: radial-gradient(1200px 500px at 25% -10%, rgb(37 99 235 / 0.10), transparent 60%),
                        radial-gradient(900px 500px at 80% -15%, rgb(251 191 36 / 0.12), transparent 55%),
                        var(--white);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: geometricPrecision;
        }

        ::selection {
            background: rgb(37 99 235 / 0.22);
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        a, button {
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        :focus-visible {
            outline: none;
            box-shadow: var(--ring);
            border-radius: 10px;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }
        
        /* Navigation Professionnelle */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            isolation: isolate;
        }
        
        .navbar.scrolled {
            box-shadow: var(--shadow-md);
        }

        .navbar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgb(37 99 235 / 0.06), transparent 30%, rgb(251 191 36 / 0.06));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .navbar.scrolled::before {
            opacity: 1;
        }
        
        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 12px 30px rgb(37 99 235 / 0.25);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
            position: relative;
            padding: 0.25rem 0;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            border: 1px solid rgb(255 255 255 / 0.14);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgb(255 255 255 / 0.18), transparent 35%, rgb(255 255 255 / 0.08));
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:hover::after {
            opacity: 1;
        }

        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* Hero Section Professionnelle */
        .hero {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
            padding: 8rem 0 6rem;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: radial-gradient(800px 400px at 20% 20%, rgb(251 191 36 / 0.22), transparent 60%),
                        radial-gradient(700px 420px at 80% 10%, rgb(255 255 255 / 0.10), transparent 55%);
            pointer-events: none;
            mix-blend-mode: overlay;
            opacity: 0.9;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .hero-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 900;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: clamp(1.125rem, 2vw, 1.5rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            max-width: 700px;
            line-height: 1.6;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-white {
            background: white;
            color: var(--primary);
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }
        
        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }
        
        /* Section Container */
        .section {
            padding: 6rem 0;
        }
        
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }
        
        .stat-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
            position: relative;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, rgb(37 99 235 / 0.08), transparent 35%, rgb(251 191 36 / 0.08));
            opacity: 0;
            transition: opacity 0.25s ease;
            pointer-events: none;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .stat-card:hover::before {
            opacity: 1;
        }
        
        .stat-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.75rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }
        
        .stat-label {
            font-size: 1.125rem;
            color: var(--gray-600);
            font-weight: 500;
        }
        
        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
            position: relative;
            transform: translateZ(0);
        }

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: linear-gradient(135deg, rgb(37 99 235 / 0.10), transparent 30%, rgb(251 191 36 / 0.10));
            opacity: 0;
            transition: opacity 0.25s ease;
            pointer-events: none;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .card:hover::before {
            opacity: 1;
        }
        
        .card-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }
        
        .card-content {
            padding: 2rem;
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.75rem;
        }
        
        .card-text {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
        }
        
        .info-item .label {
            color: var(--gray-600);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-item .value {
            font-weight: 700;
            color: var(--gray-800);
        }
        
        /* Footer */
        .footer {
            background: var(--gray-900);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }
        
        .footer-section h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            line-height: 2;
            transition: color 0.2s;
        }
        
        .footer-section a:hover {
            color: white;
        }
        
        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--gray-700);
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: var(--shadow-lg);
                gap: 0.5rem;
            }
            
            .nav-links.active {
                display: flex;
            }
            
            .hero {
                padding: 4rem 0 3rem;
            }
            
            .section {
                padding: 4rem 0;
            }
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .badge-primary {
            background: var(--primary);
            color: white;
        }
        
        .badge-yellow {
            background: var(--accent);
            color: var(--dark);
        }
        
        .profile-menu {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .profile-menu summary {
            list-style: none;
        }

        .profile-menu summary::-webkit-details-marker {
            display: none;
        }

        .profile-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 9999px;
            border: 1px solid var(--gray-200);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 10px 24px rgb(37 99 235 / 0.20);
        }

        .profile-trigger:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .profile-trigger:focus {
            outline: none;
            box-shadow: var(--ring);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 0.75rem);
            right: 0;
            width: 260px;
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            box-shadow: var(--shadow-lg);
            padding: 0.75rem;
            z-index: 1100;
            display: none;
            transform-origin: top right;
            animation: dropdownIn 0.18s ease-out;
        }

        @keyframes dropdownIn {
            from { opacity: 0; transform: translateY(-6px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .profile-menu[open] .profile-dropdown {
            display: block;
        }

        .profile-dropdown-header {
            padding: 0.5rem 0.75rem 0.75rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 0.5rem;
        }

        .profile-dropdown a,
        .profile-dropdown button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.65rem 0.75rem;
            border-radius: 10px;
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 600;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            line-height: 1.2;
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }

        .profile-dropdown a:active,
        .profile-dropdown button:active {
            transform: scale(0.99);
        }

        @media (prefers-reduced-motion: reduce) {
            * { scroll-behavior: auto !important; }
            .animate-fade-in-up { animation: none; }
            .card, .stat-card, .btn-primary { transition: none; }
        }

        .profile-dropdown a i,
        .profile-dropdown button i {
            width: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-basketball-ball"></i>
                </div>
                <span>EBOND</span>
            </a>
            
            <div class="nav-links" id="navLinks">
                <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                <a href="{{ route('about') }}" class="nav-link">À Propos</a>
                <a href="{{ route('categories.index') }}" class="nav-link">Catégories</a>
                <a href="{{ route('actualites.index') }}" class="nav-link">Actualités</a>
                <a href="{{ route('emploi-du-temps.index') }}" class="nav-link">Emploi du Temps</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire
                    </a>
                    <a href="{{ route('login') }}" style="color: #64748b; text-decoration: none; font-weight: 500; margin-left: 1rem;">
                        Connexion
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>

                    @if(Auth::user()?->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                            <i class="fas fa-shield-halved"></i>
                            Admin
                        </a>
                    @endif

                    <details class="profile-menu">
                        <summary class="profile-trigger" aria-label="Profil">
                            <i class="fas fa-user"></i>
                        </summary>

                        <div class="profile-dropdown">
                            @php
                                $fullName = trim((string) Auth::user()->name);
                                $parts = preg_split('/\s+/', $fullName, -1, PREG_SPLIT_NO_EMPTY) ?: [];
                                $prenom = $parts[0] ?? $fullName;
                                $nom = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
                            @endphp

                            <div class="profile-dropdown-header">
                                <div class="profile-dropdown-name">
                                    {{ $prenom }}@if($nom) {{ $nom }}@endif
                                </div>
                                <div class="profile-dropdown-email">{{ Auth::user()->email }}</div>
                            </div>

                            <a href="{{ route('profile.edit') }}#infos">
                                <i class="fas fa-id-card"></i>
                                Mes informations
                            </a>
                            <a href="{{ route('profile.edit') }}#mot-de-passe">
                                <i class="fas fa-key"></i>
                                Modifier mon mot de passe
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-right-from-bracket"></i>
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </details>
                @endguest
            </div>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @isset($header)
            <header class="bg-white" style="border-bottom: 1px solid var(--gray-200);">
                <div class="container" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @isset($slot)
            <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
                {{ $slot }}
            </div>
        @else
            @yield('content')
        @endisset
    </main>

    

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        const closeAllProfileMenus = () => {
            document.querySelectorAll('details.profile-menu[open]').forEach((el) => el.removeAttribute('open'));
        };

        document.addEventListener('click', (e) => {
            const clickedInsideProfileMenu = e.target.closest && e.target.closest('details.profile-menu');
            if (!clickedInsideProfileMenu) {
                closeAllProfileMenus();
            }
        });

        document.querySelectorAll('details.profile-menu .profile-dropdown a, details.profile-menu .profile-dropdown button').forEach((el) => {
            el.addEventListener('click', () => {
                closeAllProfileMenus();
            });
        });
    </script>
</body>
</html>
