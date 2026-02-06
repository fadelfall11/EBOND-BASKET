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
                            <img src="{{ asset('storage/' . $actualite->image) }}" alt="{{ $actualite->titre }}" style="width: 100%; height: auto; display: block;">
                        @else
                            <div class="card-image" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #2563eb, #3b82f6); color: white; font-size: 3rem;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                        <div class="card-content">
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
                            
                            <a href="{{ route('actualites.show', $actualite) }}" class="btn-primary" style="width: 100%; justify-content: center;">
                                Lire la suite
                                <i class="fas fa-arrow-right"></i>
                            </a>
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

@endsection
