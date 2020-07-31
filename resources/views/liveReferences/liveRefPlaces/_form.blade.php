<div class="form-group">
  <label for="name">Név</label>
  <input type="text" class="form-control lv-form{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Csoport neve..." value="{{ old('name', $liveRefPlaceToEdit->name ?? null) }}">

  @if($errors->has('name'))
  <span class="invalid-feedback">{{ $errors->first('name') }}</span>
@endif
</div>
