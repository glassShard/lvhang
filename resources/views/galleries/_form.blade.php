<div class="form-group">
  <label for="title">Galéria neve</label>
  <input type="text" class="form-control lv-form{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Név..." value="{{ old('title', $gallery->title ?? null) }}">

  @if($errors->has('title'))
    <span class="invalid-feedback">{{ $errors->first('title') }}</span>
  @endif
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="foot" id="foot1" value="live"   
    @if (old('foot'))
      {{ old('foot') }}
    @elseif($gallery ?? '' === '')
      @if ($studio ?? '' !== '')
        @if ($studio === '0')  
          checked
        @endif
      @endif
    @elseif($gallery->foot === 'live') 
      checked
    @endif
  >
  <label class="form-check-label" for="foot1">
    Élő
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="foot" id="foot2" value="studio" 
    @if (old('foot'))
      {{ old('foot') }}
    @elseif(isset($gallery))
      @if($gallery->foot === 'studio')
        checked
      @endif
    @elseif ($studio ?? '' !== '')
      @if ($studio === '1')
        checked
      @endif
    @endif
  >
  <label class="form-check-label" for="foot2"> 
    Stúdió
  </label>
</div>

@if($errors->has('foot'))
  <span class="invalid-feedback d-block">{{ $errors->first('foot') }}</span>
@endif

<div class="form-group ml-4 st-ref">
  <div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" name="ref" id="ref" value="true"
    
    @if (old('ref', null !== null))
      @if (old('ref') === true)
        checked
      @endif
    @elseif (isset($gallery))
      @if ($gallery->ref === 1) 
        checked
      @endif
    @endif
    >

    <label for="ref" class="form-check-label">Referencia-album</label>
  </div>
</div>
<br>


<div class="form-group">
  @if (old('thumbnail') | isset($gallery))
    @if ($gallery->thumbnail)  
      <img src="{{ $gallery->url('thumbnail') }}" alt="...">	
    @else
      <img src="{{ Request::root() }}/images/no_image.png" width="250" height="250" alt="...">
    @endif
  @endif
</div>
<div class="form-group">
  <label>Borítókép</label>
  <input type="file" class="form-control-file" id="image" name="image"/>

  @if($errors->has('image'))
    <span class="invalid-feedback d-block">{{ $errors->first('image') }}</span>
  @endif
</div>
<br>
<div class="form-group">
  <label for="keywords">Kulcsszavak</label>
  <input type="text" class="form-control lv-form{{ $errors->has('keywords') ? ' is-invalid' : '' }}" id="keywords" name="keywords" placeholder="Kulcsszavak..." value="{{ old('keywords', $gallery->keywords ?? null) }}">

  @if($errors->has('keywords'))
    <span class="invalid-feedback">{{ $errors->first('keywords') }}</span>
  @endif
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