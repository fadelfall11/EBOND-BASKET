@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                Notre <span style="color: #fbbf24;">Histoire</span>
            </h1>
            <p class="hero-subtitle">
                Découvrez l'histoire et les valeurs qui font notre excellence
            </p>
        </div>
    </div>
</section>

<!-- Leadership Section -->
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Notre Leadership</h2>
            <p class="section-subtitle">
                Les visionnaires qui font la grandeur de EBOND
            </p>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e40af, #2563eb); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-crown" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                    </div>
                </div>
                <div class="card-content" style="text-align: center;">
                    <h3 class="card-title" style="margin-bottom: 0.5rem;">Dieylani Kebe</h3>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge" style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                            Fondateur & Entraîneur Principal
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                        <i class="fas fa-award" style="color: #fbbf24;"></i>
                        <span>26 ans d'expérience</span>
                    </div>
                    <p class="card-text" style="text-align: left;">
                        Visionnaire passionné, Dieylani Kebe est le fondateur de EBOND. Avec plus de deux décennies d'expérience, il a su créer une école de basket de référence au Sénégal. Son expertise technique et sa capacité à développer les talents font de lui un mentor respecté qui a formé des générations de joueurs d'excellence.
                    </p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #ec4899, #f472b6); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-star" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                    </div>
                </div>
                <div class="card-content" style="text-align: center;">
                    <h3 class="card-title" style="margin-bottom: 0.5rem;">Ababacar Ndiaye</h3>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge" style="background: #fce7f3; color: #ec4899; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                            Président de Ligue de Basket de Diourbel
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                        <i class="fas fa-trophy" style="color: #fbbf24;"></i>
                        <span>Leader Dynamique</span>
                    </div>
                    <p class="card-text" style="text-align: left;">
                        Jeune leader sérieux et dynamique, Ababacar Ndiaye est un passionné qui ne vit que pour le basket diourbelois. Son engagement sans faille pour le développement du basketball dans la région de Diourbel fait de lui un acteur incontournable. Il incarne la nouvelle génération de dirigeants qui allient modernité et valeurs traditionnelles.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Coaches Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Notre Équipe d'Encadrement</h2>
            <p class="section-subtitle">
                Des coachs expérimentés passionnés par la formation des jeunes talents
            </p>
        </div>
        
        <div class="cards-grid">
            @forelse ($coaches as $coach)
                <div class="card">
                    <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                        @if($coach->photo)
                            <img src="{{ asset('images/' . $coach->photo) }}" alt="{{ $coach->prenom }} {{ $coach->nom }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; {{ $coach->photo_style }}">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #2563eb, #3b82f6); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-tie" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-content" style="text-align: center;">
                        <h3 class="card-title" style="margin-bottom: 0.5rem;">{{ $coach->prenom }} {{ $coach->nom }}</h3>
                        <div style="margin-bottom: 1rem;">
                            <span class="badge" style="background: #e0f2fe; color: #0284c7; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                                {{ $coach->specialite }}
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                            <i class="fas fa-award" style="color: #fbbf24;"></i>
                            <span>{{ $coach->experience }} ans d'expérience</span>
                        </div>
                        <p class="card-text" style="text-align: left;">{{ Str::limit($coach->bio, 120) }}</p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem;">
                    <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <i class="fas fa-users" style="font-size: 2rem; color: #94a3b8;"></i>
                    </div>
                    <p style="color: #64748b;">Notre équipe de coachs sera bientôt disponible.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero" style="padding: 6rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: white; margin-bottom: 1.5rem;">
                Rejoignez notre famille !
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.5rem;">
                Que vous soyez débutant ou joueur confirmé, nous avons une place pour vous
            </p>
            <div class="hero-buttons" style="justify-content: center;">
                <a href="{{ route('categories.index') }}" class="btn-white">
                    <i class="fas fa-users"></i>
                    Découvrir nos catégories
                </a>
                <a href="mailto:contact@ebond.sn" class="btn-outline">
                    <i class="fas fa-envelope"></i>
                    Nous contacter
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
