@extends('layouts.app')

@section('content')
@if(session('success'))
    <div style="background: #d1fae5; color: #065f46; padding: 1rem; text-align: center; border-bottom: 2px solid #6ee7b7; position: sticky; top: 80px; z-index: 999;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

 
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                École de Basket Ousseynou Ndiaga Diop<br>
                <span style="color: #fbbf24;">EBOND</span>
            </h1>
            <p class="hero-subtitle">
                Formation d'excellence, passion et développement du talent au basketball. 
                Rejoignez une communauté dédiée à l'excellence sportive et humaine.
            </p>
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('categories.index') }}" class="btn-white">
                        <i class="fas fa-users"></i>
                        Voir nos catégories
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-white">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire pour accéder
                    </a>
                @endauth
                <a href="{{ route('about') }}" class="btn-outline">
                    <i class="fas fa-info-circle"></i>
                    En savoir plus
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">L'esprit des basketteurs EBOND</h2>
            <p class="section-subtitle">
                Un état d'esprit collectif qui mélange discipline, plaisir du jeu et envie de progresser
            </p>
        </div>

        <div class="cards-grid">
            <div class="card">
                <div class="card-content">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; font-size: 1.25rem;">
                            <i class="fas fa-running"></i>
                        </div>
                        <h3 class="card-title" style="margin: 0;">Rythme & Intensité</h3>
                    </div>
                    <p class="card-text">Séquences rapides, transitions fulgurantes et défense active pour garder l'avantage.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-bolt"></i> Contre-attaque</span>
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-stopwatch"></i> Endurance</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; font-size: 1.25rem;">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="card-title" style="margin: 0;">Technique & Vision</h3>
                    </div>
                    <p class="card-text">Travail du dribble, des appuis et des lectures de jeu pour décider vite et bien.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-basketball-ball"></i> Dribble</span>
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-users"></i> Collectif</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; font-size: 1.25rem; background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="card-title" style="margin: 0;">Mental & Leadership</h3>
                    </div>
                    <p class="card-text">Confiance, esprit d'équipe et gestion de la pression pour performer ensemble.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span style="color: #9a3412; font-weight: 600;"><i class="fas fa-crown"></i> Leadership</span>
                        <span style="color: #9a3412; font-weight: 600;"><i class="fas fa-shield-alt"></i> Cohésion</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
