@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                {{ $actualite->titre }}
            </h1>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(255, 255, 255, 0.9); background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 9999px;">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $actualite->date_publication->format('d F Y') }}</span>
                </div>
                @if($actualite->auteur)
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(255, 255, 255, 0.9); background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 9999px;">
                        <i class="fas fa-user"></i>
                        <span>{{ $actualite->auteur }}</span>
                    </div>
                @endif
                <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(255, 255, 255, 0.9); background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 9999px;">
                    <i class="fas fa-clock"></i>
                    <span>{{ $actualite->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

@if($actualite->image)
<!-- Image Section -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div style="max-width: 1000px; margin: 0 auto;">
            <img src="{{ asset('images/' . $actualite->image) }}" alt="{{ $actualite->titre }}" 
                 style="width: 100%; height: auto; display: block; border-radius: 20px; box-shadow: 0 20px 25px rgba(0,0,0,0.1);">
        </div>
    </div>
</section>
@endif

<!-- Article Content -->
<section class="section">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="card">
                <div class="card-content">
                    <div style="font-size: 1.125rem; line-height: 1.9; color: #475569;">
                        {!! $actualite->contenu !!}
                    </div>
                    
                    <!-- Share Buttons -->
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #e2e8f0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span style="font-weight: 600; color: #64748b;">Partager :</span>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="#" style="width: 40px; height: 40px; background: #2563eb; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" style="width: 40px; height: 40px; background: #1da1f2; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" style="width: 40px; height: 40px; background: #25d366; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                            <button style="display: flex; align-items: center; gap: 0.5rem; background: #fee2e2; color: #dc2626; padding: 0.5rem 1rem; border-radius: 9999px; border: none; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                <i class="fas fa-heart"></i>
                                <span>J'aime</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if($actualitesRecentes->count() > 0)
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Articles Similaires</h2>
            <p class="section-subtitle">Découvrez d'autres actualités de notre école</p>
        </div>
        
        <div class="cards-grid">
            @foreach ($actualitesRecentes as $article)
                <div class="card">
                    @if($article->image)
                        <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->titre }}" style="width: 100%; height: auto; display: block;">
                    @else
                        <div class="card-image" style="display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #2563eb, #3b82f6); color: white; font-size: 3rem;">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    @endif
                    <div class="card-content">
                        <div style="font-size: 0.875rem; color: #64748b; margin-bottom: 0.75rem;">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $article->date_publication->format('d/m/Y') }}
                        </div>
                        <h3 class="card-title" style="font-size: 1.25rem;">{{ $article->titre }}</h3>
                        <p class="card-text" style="font-size: 0.95rem;">{{ Str::limit($article->extrait, 80) }}</p>
                        <a href="{{ route('actualites.show', $article) }}" class="btn-primary" style="width: 100%; justify-content: center; font-size: 0.95rem; padding: 0.75rem 1.5rem;">
                            Lire la suite
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Back Button -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div style="text-align: center;">
            <a href="{{ route('actualites.index') }}" class="btn-primary">
                <i class="fas fa-arrow-left"></i>
                Retour aux actualités
            </a>
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
