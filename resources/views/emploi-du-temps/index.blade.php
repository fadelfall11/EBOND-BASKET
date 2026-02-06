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
@endsection
