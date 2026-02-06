@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:2rem;">
                <div>
                    <h2 class="section-title" style="margin-bottom:0.25rem;">Modifier une actualité</h2>
                    <p class="section-subtitle" style="margin:0;">Met à jour puis enregistre.</p>
                </div>
                <a href="{{ route('admin.actualites.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>

            <div class="card">
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Titre *</label>
                                <input class="form-input" name="titre" value="{{ old('titre', $actualite->titre) }}" required>
                                @error('titre')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Auteur</label>
                                <input class="form-input" name="auteur" value="{{ old('auteur', $actualite->auteur) }}">
                                @error('auteur')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Date de publication *</label>
                                <input type="datetime-local" class="form-input" name="date_publication" value="{{ old('date_publication', optional($actualite->date_publication)->format('Y-m-d\\TH:i')) }}" required>
                                @error('date_publication')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-input" name="image" accept="image/*">
                                @error('image')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        @if($actualite->image)
                            <div style="margin-bottom:1rem;">
                                <div style="font-weight:600; color:#334155; margin-bottom:0.5rem;">Image actuelle</div>
                                <img src="{{ asset('storage/' . $actualite->image) }}" alt="{{ $actualite->titre }}" style="max-width: 100%; height: 260px; object-fit: cover; border-radius: 16px; border:1px solid #e2e8f0;">
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="form-label">Contenu *</label>
                            <textarea class="form-input" name="contenu" rows="10" required>{{ old('contenu', $actualite->contenu) }}</textarea>
                            @error('contenu')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Enregistrer
                            </button>
                            <a href="{{ route('admin.actualites.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
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
