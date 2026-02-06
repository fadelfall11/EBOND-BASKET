@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="margin-bottom: 2rem;">
                <a href="{{ route('emploi-du-temps.index') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>
            
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title" style="margin-bottom: 2rem;">Modifier l'entraînement</h2>
                    
                    <form action="{{ route('emploi-du-temps.update', $emploiDuTemps) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="form-label">Catégorie *</label>
                            <select name="categorie_id" class="form-input" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $emploiDuTemps->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }} - {{ $categorie->genre == 'garcon' ? 'Garçons' : 'Filles' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jour *</label>
                            <select name="jour" class="form-input" required>
                                <option value="">Sélectionner un jour</option>
                                <option value="lundi" {{ old('jour', $emploiDuTemps->jour) == 'lundi' ? 'selected' : '' }}>Lundi</option>
                                <option value="mardi" {{ old('jour', $emploiDuTemps->jour) == 'mardi' ? 'selected' : '' }}>Mardi</option>
                                <option value="mercredi" {{ old('jour', $emploiDuTemps->jour) == 'mercredi' ? 'selected' : '' }}>Mercredi</option>
                                <option value="jeudi" {{ old('jour', $emploiDuTemps->jour) == 'jeudi' ? 'selected' : '' }}>Jeudi</option>
                                <option value="vendredi" {{ old('jour', $emploiDuTemps->jour) == 'vendredi' ? 'selected' : '' }}>Vendredi</option>
                                <option value="samedi" {{ old('jour', $emploiDuTemps->jour) == 'samedi' ? 'selected' : '' }}>Samedi</option>
                                <option value="dimanche" {{ old('jour', $emploiDuTemps->jour) == 'dimanche' ? 'selected' : '' }}>Dimanche</option>
                            </select>
                            @error('jour')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Heure de début *</label>
                                <input type="time" name="heure_debut" class="form-input" value="{{ old('heure_debut', $emploiDuTemps->heure_debut) }}" required>
                                @error('heure_debut')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Heure de fin *</label>
                                <input type="time" name="heure_fin" class="form-input" value="{{ old('heure_fin', $emploiDuTemps->heure_fin) }}" required>
                                @error('heure_fin')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="lieu" class="form-input" value="{{ old('lieu', $emploiDuTemps->lieu) }}" placeholder="Ex: Terrain principal">
                            @error('lieu')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input" rows="4" placeholder="Description de l'entraînement...">{{ old('description', $emploiDuTemps->description) }}</textarea>
                            @error('description')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                            <button type="submit" class="btn-primary" style="flex: 1;">
                                <i class="fas fa-save"></i>
                                Enregistrer les modifications
                            </button>
                            <a href="{{ route('emploi-du-temps.index') }}" class="btn-outline" style="flex: 1; text-align: center; padding: 1rem; border-radius: 12px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
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
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-error {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    .btn-outline {
        background: transparent;
        color: #2563eb;
        border: 2px solid #2563eb;
    }
    
    .btn-outline:hover {
        background: #2563eb;
        color: white;
    }
</style>
@endsection
