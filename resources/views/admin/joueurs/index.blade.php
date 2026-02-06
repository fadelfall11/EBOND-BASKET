@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:1rem;">
            <div>
                <h2 class="section-title" style="margin-bottom:0.25rem;">Gestion des joueurs</h2>
                <p class="section-subtitle" style="margin:0;">Créer, modifier, supprimer.</p>
            </div>
            <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Admin
                </a>
                <a href="{{ route('admin.joueurs.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter
                </a>
            </div>
        </div>

        <div class="card" style="margin-bottom:1.5rem;">
            <div class="card-content">
                <form method="GET" action="{{ route('admin.joueurs.index') }}" style="display:flex; gap:1rem; flex-wrap:wrap; align-items:end;">
                    <div style="min-width:260px; flex:1;">
                        <label style="display:block; font-weight:600; color:#334155; margin-bottom:0.5rem;">Catégorie</label>
                        <select name="categorie_id" class="form-input" style="width:100%;">
                            <option value="">Toutes</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (string) request('categorie_id') === (string) $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom }} ({{ $cat->genre }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn-primary" type="submit" style="height:46px;">
                        <i class="fas fa-filter"></i>
                        Filtrer
                    </button>
                    <a class="btn-outline" href="{{ route('admin.joueurs.index') }}" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem; height:46px;">
                        Réinitialiser
                    </a>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="text-align:left; border-bottom:1px solid #e2e8f0;">
                                <th style="padding:0.75rem;">Joueur</th>
                                <th style="padding:0.75rem;">Catégorie</th>
                                <th style="padding:0.75rem;">Poste</th>
                                <th style="padding:0.75rem;">#</th>
                                <th style="padding:0.75rem;">Cap.</th>
                                <th style="padding:0.75rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($joueurs as $joueur)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:0.75rem;">
                                        <div style="display:flex; align-items:center; gap:0.75rem;">
                                            @if($joueur->photo)
                                                <img src="{{ asset('storage/' . $joueur->photo) }}" alt="{{ $joueur->full_name }}" style="width:44px; height:44px; border-radius:9999px; {{ $joueur->photo_style }} border:1px solid #e2e8f0;">
                                            @else
                                                <div style="width:44px; height:44px; border-radius:9999px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; border:1px solid #e2e8f0; color:#64748b;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div style="font-weight:700;">{{ $joueur->full_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $joueur->categorie?->nom }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $joueur->poste }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $joueur->numero }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $joueur->capitaine ? 'Oui' : 'Non' }}</td>
                                    <td style="padding:0.75rem;">
                                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                            <a class="btn-outline" href="{{ route('admin.joueurs.edit', $joueur) }}" style="border:2px solid #2563eb; color:#2563eb; padding:0.5rem 0.9rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.4rem;">
                                                <i class="fas fa-pen"></i>
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('admin.joueurs.destroy', $joueur) }}" onsubmit="return confirm('Supprimer ce joueur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-outline" style="border:2px solid #dc2626; color:#dc2626; padding:0.5rem 0.9rem; border-radius:10px; background:transparent; cursor:pointer; display:inline-flex; align-items:center; gap:0.4rem;">
                                                    <i class="fas fa-trash"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding:1rem; color:#64748b; text-align:center;">Aucun joueur.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($joueurs->hasPages())
                    <div style="margin-top:1.5rem;">{{ $joueurs->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    .form-input { width:100%; padding:0.875rem 1rem; border:2px solid #e2e8f0; border-radius:12px; font-size:1rem; transition: all 0.3s ease; font-family:'Poppins', sans-serif; }
    .form-input:focus { outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,0.1); }
</style>
@endsection
