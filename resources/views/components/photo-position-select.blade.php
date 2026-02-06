<div class="form-group">
    <label class="form-label" for="photo_position">Position de la photo</label>
    <select id="photo_position" name="photo_position" class="form-input">
        <option value="center" {{ old('photo_position', $photoPosition ?? 'center') === 'center' ? 'selected' : '' }}>Centré</option>
        <option value="top" {{ old('photo_position', $photoPosition ?? 'center') === 'top' ? 'selected' : '' }}>Haut</option>
        <option value="top left" {{ old('photo_position', $photoPosition ?? 'center') === 'top left' ? 'selected' : '' }}>Haut Gauche</option>
        <option value="top right" {{ old('photo_position', $photoPosition ?? 'center') === 'top right' ? 'selected' : '' }}>Haut Droit</option>
        <option value="bottom" {{ old('photo_position', $photoPosition ?? 'center') === 'bottom' ? 'selected' : '' }}>Bas</option>
        <option value="bottom left" {{ old('photo_position', $photoPosition ?? 'center') === 'bottom left' ? 'selected' : '' }}>Bas Gauche</option>
        <option value="bottom right" {{ old('photo_position', $photoPosition ?? 'center') === 'bottom right' ? 'selected' : '' }}>Bas Droit</option>
        <option value="left" {{ old('photo_position', $photoPosition ?? 'center') === 'left' ? 'selected' : '' }}>Gauche</option>
        <option value="right" {{ old('photo_position', $photoPosition ?? 'center') === 'right' ? 'selected' : '' }}>Droit</option>
    </select>
    @error('photo_position')
        <div class="form-error">{{ $message }}</div>
    @enderror
</div>
