@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                Nos <span style="color: #fbbf24;">Catégories</span>
            </h1>
            <p class="hero-subtitle">
                Découvrez toutes nos catégories de formation pour jeunes talents
            </p>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="section">
    <div class="container">
        @if(auth()->user()?->is_admin)
            <div style="text-align: right; margin-bottom: 2rem;">
                <a href="{{ route('admin.categories.index') }}" class="btn-primary">
                    <i class="fas fa-shield-halved"></i>
                    Gérer les catégories
                </a>
            </div>
        @endif
        @if ($categories->count() > 0)
            <!-- Garçons Section -->
            @if($categoriesGarcons->count() > 0)
                <div style="margin-bottom: 5rem;">
                    <div class="section-header" style="margin-bottom: 3rem;">
                        <h2 class="section-title">
                            <i class="fas fa-male" style="color: #2563eb;"></i>
                            Catégories Garçons
                        </h2>
                    </div>
                    
                    <div class="cards-grid">
                        @foreach ($categoriesGarcons as $categorie)
                            <div class="card">
                                @if($categorie->photo)
                                    <img src="{{ asset('images/' . $categorie->photo) }}" alt="{{ $categorie->nom }}" class="card-image" style="{{ $categorie->photo_style }}">
                                @else
                                    <div class="card-image" style="background: linear-gradient(135deg, #2563eb, #3b82f6); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                        <i class="fas fa-basketball-ball"></i>
                                    </div>
                                @endif
                                <div class="card-content">
                                    <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem; margin-bottom:1rem;">
                                        <h3 class="card-title" style="margin:0;">{{ $categorie->nom }}</h3>
                                        <span class="badge badge-yellow">{{ $categorie->age_min }}–{{ $categorie->age_max }} ans</span>
                                    </div>
                                    
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-users" style="color:#2563eb;"></i> Joueurs</span>
                                            <span class="value" style="color:#2563eb;">{{ $categorie->joueurs->count() }}/15</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-user-tie" style="color:#64748b;"></i> Coach</span>
                                            <span class="value">{{ $categorie->coach->prenom }} {{ $categorie->coach->nom }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-crown" style="color:#fbbf24;"></i> Capitaine</span>
                                            <span class="value" style="color:#f59e0b;">{{ optional($categorie->joueurs->where('capitaine', true)->first())->full_name ?? '—' }}</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('categories.show', $categorie) }}" class="btn-primary" style="width: 100%; justify-content: center;">
                                        Voir l'équipe
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Filles Section -->
            @if($categoriesFilles->count() > 0)
                <div>
                    <div class="section-header" style="margin-bottom: 3rem;">
                        <h2 class="section-title">
                            <i class="fas fa-female" style="color: #ec4899;"></i>
                            Catégories Filles
                        </h2>
                    </div>
                    
                    <div class="cards-grid">
                        @foreach ($categoriesFilles as $categorie)
                            <div class="card">
                                @if($categorie->photo)
                                    <img src="{{ asset('images/' . $categorie->photo) }}" alt="{{ $categorie->nom }}" class="card-image" style="{{ $categorie->photo_style }}">
                                @else
                                    <div class="card-image" style="background: linear-gradient(135deg, #ec4899, #f472b6); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                        <i class="fas fa-basketball-ball"></i>
                                    </div>
                                @endif
                                <div class="card-content">
                                    <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem; margin-bottom:1rem;">
                                        <h3 class="card-title" style="margin:0;">{{ $categorie->nom }}</h3>
                                        <span class="badge" style="background:#ec4899; color:white;">{{ $categorie->age_min }}–{{ $categorie->age_max }} ans</span>
                                    </div>
                                    
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-users" style="color:#ec4899;"></i> Joueuses</span>
                                            <span class="value" style="color:#ec4899;">{{ $categorie->joueurs->count() }}/15</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-user-tie" style="color:#64748b;"></i> Coach</span>
                                            <span class="value">{{ $categorie->coach->prenom }} {{ $categorie->coach->nom }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="label"><i class="fas fa-crown" style="color:#fbbf24;"></i> Capitaine</span>
                                            <span class="value" style="color:#f59e0b;">{{ optional($categorie->joueurs->where('capitaine', true)->first())->full_name ?? '—' }}</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('categories.show', $categorie) }}" class="btn-primary" style="width: 100%; justify-content: center; background: linear-gradient(135deg, #ec4899, #f472b6);">
                                        Voir l'équipe
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            

        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-users" style="font-size: 2rem; color: #94a3b8;"></i>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: #334155;">Aucune catégorie disponible</h3>
                <p style="color: #64748b; margin-bottom: 2rem;">Les catégories seront bientôt disponibles. Revenez nous voir !</p>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="hero" style="padding: 6rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: white; margin-bottom: 1.5rem;">
                Prêt à rejoindre une équipe ?
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.5rem;">
                Contactez-nous pour trouver la catégorie parfaite pour vous ou votre enfant
            </p>
            <div class="hero-buttons" style="justify-content: center;">
                <a href="mailto:contact@ebond.sn" class="btn-white">
                    <i class="fas fa-envelope"></i>
                    Nous contacter
                </a>
                <a href="{{ route('about') }}" class="btn-outline">
                    <i class="fas fa-info-circle"></i>
                    En savoir plus
                </a>
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
