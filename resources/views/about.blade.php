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

                        @if(Str::lower(Str::ascii($coach->prenom . ' ' . $coach->nom)) === 'alioune ndiaye')
                            <div style="margin-top: 1.25rem; display: flex; justify-content: center;">
                                <a href="{{ route('about') }}#coach-alioune-ndiaye" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.1rem; border-radius: 9999px; background: rgba(37, 99, 235, 0.12); color: #2563eb; font-weight: 700; font-size: 0.9rem; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                    Voir plus
                                    <i class="fas fa-arrow-right" style="font-size: 0.9rem;"></i>
                                </a>
                            </div>
                        @endif
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

        @if($coaches->contains(fn($c) => Str::lower(Str::ascii($c->prenom . ' ' . $c->nom)) === 'alioune ndiaye'))
            <div id="coach-alioune-ndiaye" style="margin-top: 4rem; padding-top: 1rem;">
                <div class="section-header" style="margin-bottom: 2rem; text-align: left;">
                    <h3 class="section-title" style="font-size: 1.75rem;">Alioune Ndiaye — Voir plus</h3>
                    <p class="section-subtitle" style="max-width: 900px;">
                        Galerie photos : Alioune Ndiaye avec nos jeunes talents
                    </p>
                </div>

                @php
                    $aliouneGallery = [
                        [
                            'src' => 'images/alioune ndiaye/WhatsApp Image 2026-02-25 at 01.00.28.jpeg',
                            'caption' => 'Une relation de confiance qui se voit : écoute, respect et esprit d\'équipe.',
                        ],
                        [
                            'src' => 'images/alioune ndiaye/WhatsApp Image 2026-02-25 at 01.00.28 (1).jpeg',
                            'caption' => 'Cohésion et solidarité : Alioune Ndiaye construit un groupe uni, match après match.',
                        ],
                        [
                            'src' => 'images/alioune ndiaye/WhatsApp Image 2026-02-25 at 01.03.02.jpeg',
                            'caption' => 'Transmission et motivation : un coach proche de ses joueurs, pour faire grandir les talents.',
                        ],
                    ];
                @endphp

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    @foreach($aliouneGallery as $item)
                        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 1rem; overflow: hidden;">
                            <div style="height: 260px; overflow: hidden; background: #0f172a;">
                                <img src="{{ asset($item['src']) }}" alt="Alioune Ndiaye" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                            </div>
                            <div style="padding: 1rem 1.1rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; color: #2563eb; font-weight: 700; font-size: 0.9rem;">
                                    <i class="fas fa-heart" style="color: #ef4444;"></i>
                                    <span>Entente & cohésion</span>
                                </div>
                                <p style="margin: 0; color: #475569; line-height: 1.6;">
                                    {{ $item['caption'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
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
