@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:2rem;">
                <div>
                    <h2 class="section-title" style="margin-bottom:0.25rem;">Ajouter une catégorie</h2>
                    <p class="section-subtitle" style="margin:0;">Remplis les champs puis enregistre.</p>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>

            <div class="card">
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Nom *</label>
                                <input class="form-input" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Genre *</label>
                                <select class="form-input" name="genre" required>
                                    <option value="">Sélectionner</option>
                                    <option value="garcon" {{ old('genre') === 'garcon' ? 'selected' : '' }}>garcon</option>
                                    <option value="fille" {{ old('genre') === 'fille' ? 'selected' : '' }}>fille</option>
                                </select>
                                @error('genre')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                            <div class="form-group">
                                <label class="form-label">Âge min *</label>
                                <input type="number" class="form-input" name="age_min" value="{{ old('age_min') }}" required>
                                @error('age_min')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Âge max *</label>
                                <input type="number" class="form-input" name="age_max" value="{{ old('age_max') }}" required>
                                @error('age_max')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Coach *</label>
                            <select class="form-input" name="coach_id" required>
                                <option value="">Sélectionner un coach</option>
                                @foreach($coaches as $coach)
                                    <option value="{{ $coach->id }}" {{ (string) old('coach_id') === (string) $coach->id ? 'selected' : '' }}>
                                        {{ $coach->prenom }} {{ $coach->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('coach_id')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-input" name="description" rows="6">{{ old('description') }}</textarea>
                            @error('description')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-input" name="photo" accept="image/*">
                            @error('photo')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Enregistrer
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
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
