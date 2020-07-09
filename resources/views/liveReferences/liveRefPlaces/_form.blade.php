<div class="form-group">
  <label for="name">Név</label>
  <input type="text" class="form-control lv-form" id="name" name="name" placeholder="Csoport neve..." value="{{ old('name', $liveRefPlaceToEdit->name ?? null) }}">
</div>

@if($errors->any())
  <div>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  <br>
@endif