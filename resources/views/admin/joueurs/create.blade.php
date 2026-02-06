@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:2rem;">
                <div>
                    <h2 class="section-title" style="margin-bottom:0.25rem;">Ajouter un joueur</h2>
                    <p class="section-subtitle" style="margin:0;">Remplis les champs puis enregistre.</p>
                </div>
                <a href="{{ route('admin.joueurs.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>

            <div class="card">
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.joueurs.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Prénom *</label>
                                <input class="form-input" name="prenom" value="{{ old('prenom') }}" required>
                                @error('prenom')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom *</label>
                                <input class="form-input" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Poste *</label>
                                <input class="form-input" name="poste" value="{{ old('poste') }}" required>
                                @error('poste')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Catégorie *</label>
                                <select class="form-input" name="categorie_id" required>
                                    <option value="">Sélectionner</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ (string) old('categorie_id') === (string) $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nom }} ({{ $cat->genre }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('categorie_id')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Numéro *</label>
                                <input type="number" class="form-input" name="numero" value="{{ old('numero') }}" required>
                                @error('numero')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group" style="display:flex; align-items:center; gap:0.75rem; padding-top:2rem;">
                                <input id="capitaine" type="checkbox" name="capitaine" value="1" {{ old('capitaine') ? 'checked' : '' }}>
                                <label for="capitaine" style="font-weight:600; color:#334155;">Capitaine</label>
                                @error('capitaine')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-input" name="photo" accept="image/*">
                            @error('photo')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Éloges</label>
                            <textarea class="form-input" name="eloges" rows="6">{{ old('eloges') }}</textarea>
                            @error('eloges')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Enregistrer
                            </button>
                            <a href="{{ route('admin.joueurs.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-group { margin-bottom: 1.25rem; }
    .form-label { display:block; font-weight:600; color:#334155; margin-bottom:0.5rem; font-size:0.95rem; }
    .form-input { width:100%; padding:0.875rem 1rem; border:2px solid #e2e8f0; border-radius:12px; font-size:1rem; transition: all 0.3s ease; font-family:'Poppins', sans-serif; }
    .form-input:focus { outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,0.1); }
    .form-error { color:#dc2626; font-size:0.875rem; margin-top:0.5rem; }
</style>
@endsection
