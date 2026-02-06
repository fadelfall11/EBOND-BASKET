@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:2rem;">
            <div>
                <h2 class="section-title" style="margin-bottom:0.25rem;">Gestion des catégories</h2>
                <p class="section-subtitle" style="margin:0;">Créer, modifier, supprimer.</p>
            </div>
            <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Admin
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse: collapse;">
                        <thead>
                            <tr style="text-align:left; border-bottom:1px solid #e2e8f0;">
                                <th style="padding:0.75rem;">Nom</th>
                                <th style="padding:0.75rem;">Genre</th>
                                <th style="padding:0.75rem;">Âges</th>
                                <th style="padding:0.75rem;">Coach</th>
                                <th style="padding:0.75rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $categorie)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:0.75rem; font-weight:600;">{{ $categorie->nom }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $categorie->genre }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $categorie->age_min }} - {{ $categorie->age_max }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $categorie->coach?->prenom }} {{ $categorie->coach?->nom }}</td>
                                    <td style="padding:0.75rem;">
                                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                            <a class="btn-outline" href="{{ route('admin.categories.edit', $categorie) }}" style="border:2px solid #2563eb; color:#2563eb; padding:0.5rem 0.9rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.4rem;">
                                                <i class="fas fa-pen"></i>
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $categorie) }}" onsubmit="return confirm('Supprimer cette catégorie ?');">
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
                                    <td colspan="5" style="padding:1rem; color:#64748b; text-align:center;">Aucune catégorie.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($categories->hasPages())
                    <div style="margin-top:1.5rem;">{{ $categories->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
