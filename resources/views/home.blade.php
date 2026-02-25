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
                <a href="{{ route('categories.index') }}" class="btn-white">
                    <i class="fas fa-users"></i>
                    Voir nos catégories
                </a>
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
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="card-title" style="margin: 0;">Excellence & Savoir</h3>
                    </div>
                    <p class="card-text">À EBOND, nous valorisons les bons élèves, la discipline scolaire et la curiosité pour apprendre et grandir.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-book"></i> Études</span>
                        <span style="color: #1e40af; font-weight: 600;"><i class="fas fa-lightbulb"></i> Savoir</span>
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

<!-- Credit Bar -->
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-top: 1px solid #334155; color: white; padding: 1.5rem 0; text-align: center; font-size: 0.875rem; position: relative; overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; position: relative; z-index: 2;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-code" style="color: #fbbf24; font-size: 1rem;"></i>
                <span style="color: #94a3b8; font-weight: 400;">Développé par</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <strong style="color: #f1f5f9; font-weight: 600; font-size: 0.95rem;">Mohamed Fadel Fall</strong>
                <span style="background: rgba(251, 191, 36, 0.2); color: #fbbf24; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; border: 1px solid rgba(251, 191, 36, 0.3);">
                    Junior Developer
                </span>
            </div>
        </div>
        <div style="margin-top: 0.5rem; color: #64748b; font-size: 0.75rem;">
            © {{ date('Y') }} EBOND Basket — Tous droits réservés
        </div>
    </div>
    <!-- Subtle animated pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px; pointer-events: none;"></div>
</div>
@endsection
