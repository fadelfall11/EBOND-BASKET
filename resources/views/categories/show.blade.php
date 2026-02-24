@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero" style="{{ $categorie->photo ? "background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('" . asset('images/' . $categorie->photo) . "'); background-size: cover; background-position: " . ($categorie->photo_position ?? 'center') . ";" : "background: linear-gradient(135deg, " . ($categorie->genre == 'garcon' ? '#1e40af' : '#ec4899') . " 0%, " . ($categorie->genre == 'garcon' ? '#2563eb' : '#f472b6') . " 100%);" }}">
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
                         <img src="{{ asset('images/' . $categorie->coach->photo) }}" alt="{{ $categorie->coach->prenom }} {{ $categorie->coach->nom }}" 
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
                                <img src="{{ asset('images/' . $joueur->photo) }}" alt="{{ $joueur->full_name }}" 
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
