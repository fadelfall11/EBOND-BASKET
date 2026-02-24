@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                Emploi du <span style="color: #fbbf24;">Temps</span>
            </h1>
            <p class="hero-subtitle">
                Consultez les horaires d'entraînement de toutes les catégories pour la semaine
            </p>
        </div>
    </div>
</section>

<!-- Emploi du Temps Section -->
<section class="section">
    <div class="container">
        @if(auth()->user()?->is_admin)
            <div style="text-align: right; margin-bottom: 2rem;">
                <a href="{{ route('emploi-du-temps.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter un entraînement
                </a>
            </div>
        @endif
        
        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid #6ee7b7;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @foreach ($groupes as $cle => $groupe)
            <div class="card" style="margin-bottom: 3rem;">
                <div class="card-content">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                        <div>
                            <h2 class="card-title" style="margin-bottom: 0.5rem;">
                                {{ $groupe['label'] }}
                            </h2>
                            <p style="color: #64748b;">
                                Horaires regroupés par jour pour l’ensemble des catégories concernées
                            </p>
                        </div>
                        <span class="badge badge-primary">Regroupé</span>
                    </div>
                    
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1e293b;">Jour</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1e293b;">Heure</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1e293b;">Catégorie</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1e293b;">Lieu</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 700; color: #1e293b;">Description</th>
                                    @if(auth()->user()?->is_admin)
                                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #1e293b;">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jours as $jour)
                                    @php
                                        $entrainements = collect($groupe['categories'])
                                            ->flatMap(function($c) { return $c->emploiDuTemps; })
                                            ->where('jour', $jour)
                                            ->sortBy('heure_debut');
                                    @endphp
                                    @if($entrainements->count() > 0)
                                        @foreach($entrainements as $entrainement)
                                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                                <td style="padding: 1rem;">
                                                    <span style="font-weight: 600; color: #1e293b; text-transform: capitalize;">{{ $jour }}</span>
                                                </td>
                                                <td style="padding: 1rem;">
                                                    <span style="color: #2563eb; font-weight: 600;">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $entrainement->heure_debut }} - 
                                                        {{ $entrainement->heure_fin }}
                                                    </span>
                                                </td>
                                                <td style="padding: 1rem; color: #1e293b;">
                                                    {{ $entrainement->categorie->nom }} - {{ $entrainement->categorie->genre == 'garcon' ? 'Garçons' : 'Filles' }}
                                                </td>
                                                <td style="padding: 1rem; color: #64748b;">
                                                    @if($entrainement->lieu)
                                                        <i class="fas fa-map-marker-alt"></i> {{ $entrainement->lieu }}
                                                    @else
                                                        <span style="color: #94a3b8;">Non spécifié</span>
                                                    @endif
                                                </td>
                                                <td style="padding: 1rem; color: #64748b;">
                                                    {{ $entrainement->description ?? '-' }}
                                                </td>
                                                @if(auth()->user()?->is_admin)
                                                    <td style="padding: 1rem; text-align: center;">
                                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                                            <a href="{{ route('emploi-du-temps.edit', $entrainement) }}" 
                                                               style="padding: 0.5rem; background: #2563eb; color: white; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
                                                               onmouseover="this.style.background='#1e40af'" 
                                                               onmouseout="this.style.background='#2563eb'">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('emploi-du-temps.destroy', $entrainement) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        style="padding: 0.5rem; background: #dc2626; color: white; border: none; border-radius: 8px; cursor: pointer; transition: all 0.2s;"
                                                                        onmouseover="this.style.background='#b91c1c'" 
                                                                        onmouseout="this.style.background='#dc2626'"
                                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet entraînement ?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr style="border-bottom: 1px solid #e2e8f0;">
                                            <td style="padding: 1rem; color: #94a3b8; text-transform: capitalize;">{{ $jour }}</td>
                                            <td colspan="{{ auth()->user()?->is_admin ? '5' : '4' }}" style="padding: 1rem; color: #94a3b8; font-style: italic;">Aucun entraînement</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
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
