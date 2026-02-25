@extends('layouts.app')

@section('content')
<section class="hero" style="padding: 6rem 0 4rem;">
    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
            <div style="min-width: 260px;">
                <div style="display: inline-flex; align-items: center; gap: 0.6rem; padding: 0.35rem 0.75rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: rgba(255,255,255,0.92); font-weight: 700; font-size: 0.85rem;">
                    <i class="fas fa-users" style="color: #fbbf24;"></i>
                    <span>Notre Équipe d'Encadrement</span>
                </div>
                <h1 class="section-title" style="margin: 1rem 0 0; font-size: clamp(2.1rem, 4vw, 3.2rem); color: white;">
                    {{ $coach->prenom }} <span style="color: #fbbf24;">{{ $coach->nom }}</span>
                </h1>
                <p class="section-subtitle" style="margin: 0.75rem 0 0; max-width: 900px; color: rgba(255,255,255,0.9);">
                    {{ $coach->specialite }}
                    @if($coach->experience)
                        — {{ $coach->experience }} ans d'expérience
                    @endif
                </p>

                <div style="margin-top: 1.25rem; display: flex; gap: 0.65rem; flex-wrap: wrap;">
                    <span style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.4rem 0.75rem; border-radius: 9999px; background: rgba(15,23,42,0.35); border: 1px solid rgba(255,255,255,0.16); color: rgba(255,255,255,0.92); font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-star" style="color: #fbbf24;"></i>
                        Mentor
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.4rem 0.75rem; border-radius: 9999px; background: rgba(15,23,42,0.35); border: 1px solid rgba(255,255,255,0.16); color: rgba(255,255,255,0.92); font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-handshake" style="color: #fbbf24;"></i>
                        Cohésion
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.4rem 0.75rem; border-radius: 9999px; background: rgba(15,23,42,0.35); border: 1px solid rgba(255,255,255,0.16); color: rgba(255,255,255,0.92); font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-shield-heart" style="color: #fbbf24;"></i>
                        Engagement
                    </span>
                </div>
            </div>

            <a href="{{ route('about') }}" class="btn-outline" style="text-decoration: none; border-color: rgba(255,255,255,0.7);">
                <i class="fas fa-arrow-left"></i>
                Retour
            </a>
        </div>
    </div>
</section>

<section class="section" style="padding-top: 0; background: radial-gradient(900px 420px at 20% -10%, rgba(37, 99, 235, 0.10), transparent 60%), radial-gradient(700px 420px at 85% -15%, rgba(251, 191, 36, 0.10), transparent 55%), #ffffff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; align-items: start;">
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 1.15rem; overflow: hidden; box-shadow: 0 20px 48px rgba(15, 23, 42, 0.10);">
                <div style="height: 440px; overflow: hidden; background: #0f172a; position: relative;">
                    <div style="position: absolute; inset: 0; background: radial-gradient(600px 320px at 20% 20%, rgba(251, 191, 36, 0.15), transparent 60%), radial-gradient(700px 360px at 80% 10%, rgba(255,255,255,0.10), transparent 55%); pointer-events: none;"></div>
                    @if($coach->photo)
                        <img src="{{ asset('images/' . $coach->photo) }}" alt="{{ $coach->prenom }} {{ $coach->nom }}" style="width: 100%; height: 100%; object-fit: cover; {{ $coach->photo_style }}">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 4rem;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    @endif
                </div>
                <div style="padding: 1.35rem 1.35rem 1.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                            <div>
                                <div style="font-weight: 900; font-size: 1.25rem; color: #0f172a;">
                                    {{ $coach->prenom }} {{ $coach->nom }}
                                </div>
                                <div style="margin-top: 0.25rem; color: #64748b; font-weight: 700;">
                                    {{ $coach->specialite }}
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-weight: 700;">
                                <i class="fas fa-award" style="color: #fbbf24;"></i>
                                <span>{{ $coach->experience }} ans</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
                            <span class="badge" style="background: #e0f2fe; color: #0284c7; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 800; font-size: 0.8rem;">
                                Encadrement
                            </span>
                            <span class="badge" style="background: rgba(37, 99, 235, 0.10); color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 800; font-size: 0.8rem; border: 1px solid rgba(37, 99, 235, 0.18);">
                                Discipline
                            </span>
                            <span class="badge" style="background: rgba(251, 191, 36, 0.14); color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 800; font-size: 0.8rem; border: 1px solid rgba(251, 191, 36, 0.20);">
                                Engagement
                            </span>
                        </div>

                        <p style="margin: 0; color: #475569; line-height: 1.85;">
                            {{ $coach->bio }}
                        </p>

                        @if(Str::lower(Str::ascii($coach->prenom . ' ' . $coach->nom)) === 'alioune ndiaye')
                            <div style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.10), rgba(251, 191, 36, 0.10)); border: 1px solid rgba(148, 163, 184, 0.35); border-radius: 1rem; padding: 1.1rem 1.1rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 0.75rem;">
                                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                                        <div style="width: 38px; height: 38px; border-radius: 12px; background: rgba(37, 99, 235, 0.14); display: inline-flex; align-items: center; justify-content: center; color: #2563eb;">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div style="font-weight: 900; color: #0f172a;">À propos</div>
                                    </div>
                                    <span class="badge" style="background: rgba(251, 191, 36, 0.20); color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 900; font-size: 0.8rem; border: 1px solid rgba(251, 191, 36, 0.30);">
                                        INSEPS — 2023
                                    </span>
                                </div>
                                <p style="margin: 0; color: #475569; line-height: 1.85;">
                                    Alioune Ndiaye est diplômé de l'INSEPS (Institut National Supérieur de l'Éducation Populaire et du Sport) en 2023.
                                    Professeur d'Éducation Physique et Sportive, il incarne le sérieux, la transmission et l'exigence.
                                    Il fait la fierté du basket diourbelois.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <div class="section-header" style="margin-bottom: 1.5rem; text-align: left;">
                    <h2 class="section-title" style="font-size: 1.85rem; margin-bottom: 0.55rem;">Galerie</h2>
                    <p class="section-subtitle" style="max-width: 900px;">
                        Des moments qui illustrent l'entente, la cohésion et l'esprit de famille entre le coach et les basketteurs.
                    </p>
                </div>

                @if(($gallery ?? collect())->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                        @foreach($gallery as $index => $src)
                            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 1.1rem; overflow: hidden; box-shadow: 0 16px 38px rgba(15, 23, 42, 0.10);">
                                <div style="height: 270px; overflow: hidden; background: #0f172a; position: relative;">
                                    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15,23,42,0.00) 60%, rgba(15,23,42,0.55)); pointer-events: none;"></div>
                                    <img src="{{ asset($src) }}" alt="{{ $coach->prenom }} {{ $coach->nom }}" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                                </div>
                                <div style="padding: 1rem 1.1rem;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.65rem;">
                                        <div style="display: flex; align-items: center; gap: 0.55rem; color: #2563eb; font-weight: 900; font-size: 0.92rem;">
                                            <i class="fas fa-heart" style="color: #ef4444;"></i>
                                            <span>Entente & cohésion</span>
                                        </div>
                                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.6rem; border-radius: 9999px; background: rgba(37, 99, 235, 0.10); border: 1px solid rgba(37, 99, 235, 0.16); color: #1e40af; font-weight: 900; font-size: 0.75rem;">
                                            <i class="fas fa-camera" style="font-size: 0.8rem;"></i>
                                            Photo
                                        </span>
                                    </div>
                                    <p style="margin: 0; color: #475569; line-height: 1.7;">
                                        {{ ($captions[$index] ?? $captions[$index % max(1, count($captions))] ?? '') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.25rem; color: #64748b;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-images" style="color: #2563eb;"></i>
                            <span>Galerie en cours de préparation. Ajoute des photos et elles apparaîtront ici.</span>
                        </div>
                    </div>
                @endif
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
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px; pointer-events: none;"></div>
</div>
@endsection
