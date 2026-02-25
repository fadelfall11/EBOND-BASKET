@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                Nos <span style="color: #fbbf24;">Actualités</span>
            </h1>
            <p class="hero-subtitle">
                Restez informé des dernières nouvelles et événements de l'école de basket EBOND
            </p>
        </div>
    </div>
</section>

<!-- News Grid Section -->
<section class="section">
    <div class="container">
        @if(auth()->user()?->is_admin)
            <div style="text-align: right; margin-bottom: 2rem;">
                <a href="{{ route('admin.actualites.index') }}" class="btn-primary">
                    <i class="fas fa-shield-halved"></i>
                    Gérer les actualités
                </a>
            </div>
        @endif
        @if ($actualites->count() > 0)
            <div class="cards-grid">
                @foreach ($actualites as $actualite)
                    <div class="card">
                        @if($actualite->image)
                            @php
                                $titleLower = \Illuminate\Support\Str::lower($actualite->titre ?? '');
                                $objectPosition = str_contains($titleLower, 'tournoi de basket feu bassirou faye')
                                    ? 'center top'
                                    : 'center';
                            @endphp
                            <div style="height: 240px; overflow: hidden; background: #0f172a; position: relative;">
                                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15,23,42,0.00) 55%, rgba(15,23,42,0.55)); pointer-events: none;"></div>
                                <img src="{{ asset('images/' . $actualite->image) }}" alt="{{ $actualite->titre }}" style="width: 100%; height: 100%; object-fit: cover; object-position: {{ $objectPosition }}; display: block;">
                            </div>
                        @else
                            <div class="card-image" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #2563eb, #3b82f6); color: white; font-size: 3rem;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                        <div class="card-content" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.875rem; color: #64748b; flex-wrap: wrap;">
                                <span style="display: flex; align-items: center; gap: 0.25rem;">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $actualite->date_publication->format('d F Y') }}
                                </span>
                                @if($actualite->auteur)
                                    <span style="display: flex; align-items: center; gap: 0.25rem;">
                                        <i class="fas fa-user"></i>
                                        {{ $actualite->auteur }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="card-title">{{ $actualite->titre }}</h3>
                            <p class="card-text">{{ $actualite->extrait }}</p>
                            
                            <div style="margin-top: auto; padding-top: 1rem;">
                                <a href="{{ route('actualites.show', $actualite) }}" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.75rem 1.1rem;">
                                    Lire la suite
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($actualites->hasPages())
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $actualites->links() }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-newspaper" style="font-size: 2rem; color: #94a3b8;"></i>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: #334155;">Aucune actualité pour le moment</h3>
                <p style="color: #64748b; margin-bottom: 2rem;">Revenez bientôt pour découvrir les dernières nouvelles de notre école</p>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
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
