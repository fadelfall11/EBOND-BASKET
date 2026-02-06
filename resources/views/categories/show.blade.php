@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero" style="{{ $categorie->photo ? "background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('" . asset('storage/' . $categorie->photo) . "'); background-size: cover; background-position: " . ($categorie->photo_position ?? 'center') . ";" : "background: linear-gradient(135deg, " . ($categorie->genre == 'garcon' ? '#1e40af' : '#ec4899') . " 0%, " . ($categorie->genre == 'garcon' ? '#2563eb' : '#f472b6') . " 100%);" }}">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                {{ $categorie->nom }}
            </h1>
            <p class="hero-subtitle">
                Catégorie {{ $categorie->genre == 'garcon' ? 'Garçons' : 'Filles' }}
            </p>
            
            <!-- Coach Card -->
            <div style="width: 300px; margin: 2rem auto 0; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                <!-- Header -->
                <div style="background: linear-gradient(135deg, {{ $categorie->genre == 'garcon' ? '#f59e0b' : '#f59e0b' }}, {{ $categorie->genre == 'garcon' ? '#fbbf24' : '#fbbf24' }}); color: white; padding: 0.75rem; text-align: center; font-weight: 700;">
                    <i class="fas fa-user-tie"></i> Coach Responsable
                </div>
                
                <!-- Photo -->
                <div style="height: 350px; overflow: hidden; background: #f8fafc; position: relative;">
                    @if($categorie->coach && $categorie->coach->photo)
                         <img src="{{ asset('storage/' . $categorie->coach->photo) }}" alt="{{ $categorie->coach->prenom }} {{ $categorie->coach->nom }}" 
                              style="width: 100%; height: 100%; object-fit: cover; {{ $categorie->coach->photo_style }}">
                    @else
                         <div style="width: 100%; height: 100%; background: linear-gradient(135deg, {{ $categorie->genre == 'garcon' ? '#2563eb' : '#ec4899' }}, {{ $categorie->genre == 'garcon' ? '#3b82f6' : '#f472b6' }}); display: flex; align-items: center; justify-content: center;">
                             <i class="fas fa-user-tie" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                         </div>
                    @endif
                </div>
                
                <!-- Info -->
                <div style="padding: 1rem; text-align: center; background: white;">
                    <div style="font-weight: 700; font-size: 1.25rem; color: #1e293b; margin-bottom: 0.25rem;">{{ $categorie->coach?->prenom }} {{ $categorie->coach?->nom }}</div>
                    <div style="color: #64748b; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">{{ $categorie->coach?->specialite }}</div>
                    @if($categorie->coach && $categorie->coach->experience !== null)
                        <div style="color: #94a3b8; font-size: 0.875rem;">
                            <i class="fas fa-award" style="color: #fbbf24;"></i> {{ $categorie->coach->experience }} ans d'expérience
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Players Grid -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">L'Équipe</h2>
            <p class="section-subtitle">Rencontrez tous nos {{ $categorie->genre == 'garcon' ? 'joueurs' : 'joueuses' }} talentueux</p>
        </div>
        
        @if ($categorie->joueurs->count() > 0)
            <div class="cards-grid">
                @foreach ($categorie->joueurs as $joueur)
                    <div class="card" style="{{ $joueur->capitaine ? 'border: 2px solid #fbbf24;' : '' }}">
                        @if($joueur->capitaine)
                            <div style="background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; text-align: center; padding: 0.5rem; font-weight: 700;">
                                <i class="fas fa-crown"></i> Capitaine
                            </div>
                        @endif
                        
                        <div class="card-image" style="height: 320px; padding: 0; overflow: hidden; position: relative; background: {{ $categorie->genre == 'garcon' ? '#f1f5f9' : '#fff1f2' }};">
                            @if($joueur->photo)
                                <img src="{{ asset('storage/' . $joueur->photo) }}" alt="{{ $joueur->full_name }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; {{ $joueur->photo_style }}">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, {{ $categorie->genre == 'garcon' ? '#2563eb' : '#ec4899' }}, {{ $categorie->genre == 'garcon' ? '#3b82f6' : '#f472b6' }}); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-content">
                            <h3 class="card-title" style="text-align: center; margin-bottom: 1rem;">{{ $joueur->full_name }}</h3>
                            
                            <div style="display: flex; gap: 0.5rem; justify-content: center; margin-bottom: 1.5rem; flex-wrap: wrap;">
                                <span class="badge badge-primary">#{{ $joueur->numero }}</span>
                                <span class="badge" style="background: #64748b; color: white;">{{ $joueur->poste }}</span>
                            </div>
                            
                            @if($joueur->eloges)
                                <p class="card-text" style="text-align: center; font-style: italic; color: #64748b;">{{ Str::limit($joueur->eloges, 100) }}</p>
                            @else
                                <p style="text-align: center; color: #94a3b8; font-style: italic;">Profil du joueur à venir...</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-users" style="font-size: 2rem; color: #94a3b8;"></i>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: #334155;">
                    Aucun{{ $categorie->genre == 'garcon' ? ' joueur' : 'e joueuse' }} dans cette catégorie
                </h3>
                <p style="color: #64748b; margin-bottom: 2rem;">L'équipe est en cours de formation. Revenez bientôt !</p>
                <a href="{{ route('categories.index') }}" class="btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Retour aux catégories
                </a>
            </div>
        @endif
    </div>
</section>

@if($categorie->description)
<!-- Description Section -->
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="card">
                <div class="card-content">
                    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e293b;">
                        <i class="fas fa-info-circle" style="color: {{ $categorie->genre == 'garcon' ? '#2563eb' : '#ec4899' }};"></i>
                        À propos de cette catégorie
                    </h2>
                    <div style="font-size: 1.125rem; line-height: 1.8; color: #475569;">
                        {!! $categorie->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="hero" style="padding: 6rem 0; background: linear-gradient(135deg, {{ $categorie->genre == 'garcon' ? '#1e40af' : '#ec4899' }} 0%, {{ $categorie->genre == 'garcon' ? '#2563eb' : '#f472b6' }} 100%);">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: white; margin-bottom: 1.5rem;">
                Intéressé(e) par cette catégorie ?
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.5rem;">
                Contactez notre coach pour plus d'informations sur les inscriptions
            </p>
            <div class="hero-buttons" style="justify-content: center;">
                @auth
                    <a href="mailto:{{ $categorie->coach?->email ?? 'contact@ebond.sn' }}" class="btn-white">
                        <i class="fas fa-envelope"></i>
                        Contacter le coach
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-white">
                        <i class="fas fa-user-plus"></i>
                        S'inscrire pour contacter
                    </a>
                @endauth
                <a href="{{ route('categories.index') }}" class="btn-outline">
                    <i class="fas fa-list"></i>
                    Voir autres catégories
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
