<div class="form-group">
  <label for="performer">Előadó</label>
  <input type="text" class="form-control lv-form{{ $errors->has('performer') ? ' is-invalid' : '' }}" id="performer" name="performer" placeholder="Előadó..." value="{{ old('performer', $record->performer ?? null) }}">

  @if($errors->has('performer'))
    <span class="invalid-feedback">{{ $errors->first('performer') }}</span>
  @endif
</div>
<div class="form-group">
  <label for="title">Cím</label>
  <input type="text" class="form-control lv-form{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Cím..." value="{{ old('title', $record->title ?? null) }}">
  
  @if($errors->has('title'))
    <span class="invalid-feedback">{{ $errors->first('title') }}</span>
  @endif
</div>
<div class="form-group">
  <label for="type">Típus</label>
  <input type="text" class="form-control lv-form{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" placeholder="CD-DVD-2CD stb..." value="{{ old('type', $record->type ?? null) }}">
    
  @if($errors->has('type'))
    <span class="invalid-feedback">{{ $errors->first('type') }}</span>
  @endif
</div>
<div class="form-group">
  <label for="year">Kiadás éve</label>
  <input type="text" class="form-control lv-form{{ $errors->has('year') ? ' is-invalid' : '' }}" id="year" name="year" placeholder="Évszám, ahogy látni szeretnéd az oldalon..." value="{{ old('year', $record->year ?? null)}}">    
  
  @if($errors->has('year'))
    <span class="invalid-feedback">{{ $errors->first('year') }}</span>
  @endif

</div>
<div class="form-group">
  <label for="content">Leírás</label>
  @if (isset($record)) 
    @trix($record, 'content',  ['hideTools' => ['file-tools']])

  @else
    @trix(\App\Record::class, 'content', ['hideTools' => ['file-tools']])
  @endif

</div>

<div class="form-group">
  <label for="keywords">Kulcsszavak</label>
  <input type="text" class="form-control lv-form{{ $errors->has('keywords') ? ' is-invalid' : '' }}" id="keywords" name="keywords" placeholder="Kulcsszavak..." value="{{ old('keywords', $record->keywords ?? null) }}">

</div>

<div class="form-group">

</div>
<div class="form-group">
  <label>Kép</label>
  <input type="file" class="form-control-file" id="image" name="image"/>
    
  @if($errors->has('image'))
    <span class="invalid-feedback d-block">{{ $errors->first('image') }}</span>
  @endif
</div>
<br>