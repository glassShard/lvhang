<div class="form-group">
  <label for="title">Cím</label>
  <input type="text" class="form-control lv-form{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Cím..." value="{{ old('title', $new->title ?? null) }}">

  @if($errors->has('title'))
    <span class="invalid-feedback">{{ $errors->first('title') }}</span>
  @endif
</div>
<div class="form-group">
  <label for="content">Szöveg</label>
{{--   @if (old('news-trixFields') ?? null !== null)
  ezt itt félbehagytam, de még meg kell csinálni
   --}}
  @if (isset($new)) 
    @trix($new, 'content', ['hideTools' => ['file-tools']])

  @else
    @trix(\App\News::class, 'content', ['hideTools' => ['file-tools']])
  @endif

</div>

<div class="form-group">
  <label for="title">Képgaléria</label>
  <select class="custom-select lv-select lv-form" name='gallery_id'>
    <option value="0" 
      @if (old('gallery_id', null) === null)
        @if (isset($new))
          @if (!isset($new->gallery_id))
            selected
          @endif
        @else
          selected
        @endif
      @endif
    >Itt választhatsz képgalériát (nincs kiválasztva)</option>
    
    @if (isset($galleries))
      @foreach ($galleries as $gallery)
        <option value="{{ $gallery->id }}" 
          @if (old('gallery_id', null) !== null)
            @if (old('gallery_id') === $gallery->id)
              selected
            @endif
          @elseif (isset($new))
            @if (isset($new->gallery_id))
              @if ($new->gallery_id === $gallery->id)
                selected
              @endif
            @endif
          @endif
        >{{ $gallery->title }}</option>
      @endforeach
    @endif
  </select>

  @if($errors->has('gallery_id'))
    <span class="invalid-feedback">{{ $errors->first('gallery_id') }}</span>
  @endif
</div>

<div class="form-group">
  <label for="video">Video</label>
  <input type="text" class="form-control lv-form{{ $errors->has('video') ? ' is-invalid' : '' }}" id="video" name="video" placeholder="Youtube video url..." value="{{ old('video', $new->video ?? null)}}">

  @if($errors->has('video'))
    <span class="invalid-feedback">{{ $errors->first('video') }}</span>
  @endif
</div>

<div class="form-group">
  @if (old('thumbnail') | isset($new))
    @if ($new->cover)  
      <img src="{{ $new->url('thumbnail') }}" alt="...">	
    @else
      <img src="{{ Request::root() }}/images/no_image.png" width="250" height="250" alt="...">
    @endif
  @endif
</div>
<div class="form-group">
  <label>Kép</label>
  <input type="file" class="form-control-file" id="cover" name="cover"/>
  
  @if($errors->has('cover'))
    <span class="invalid-feedback d-block">{{ $errors->first('cover') }}</span>
  @endif              
</div>
<br>

<div class="form-group">
  <label for="keywords">Kulcsszavak</label>
  <input type="text" class="form-control lv-form{{ $errors->has('keywords') ? ' is-invalid' : '' }}" id="keywords" name="keywords" placeholder="Kulcsszavak..." value="{{ old('keywords', $new->keywords ?? null) }}">

  @if($errors->has('keywords'))
    <span class="invalid-feedback">{{ $errors->first('keywords') }}</span>
  @endif
</div>