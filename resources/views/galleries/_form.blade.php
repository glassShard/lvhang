<div class="form-group">
  <label for="title">Galéria neve</label>
  <input type="text" class="form-control lv-form" id="title" name="title" placeholder="Név..." value="{{ old('title', $gallery->title ?? null) }}">
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="foot" id="foot1" value="live"   
    @if (old('foot'))
      {{ old('foot') }}
    @elseif($gallery ?? '' === '')
      checked
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
    @endif
  >
  <label class="form-check-label" for="foot2"> 
    Stúdió
  </label>
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
</div>
<br>

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