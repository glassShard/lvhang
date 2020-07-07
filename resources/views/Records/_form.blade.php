<div class="form-group">
  <label for="performer">Előadó</label>
  <input type="text" class="form-control lv-form" id="performer" name="performer" placeholder="Előadó..." value="{{ old('performer', $record->performer ?? null) }}">
</div>
<div class="form-group">
  <label for="title">Cím</label>
  <input type="text" class="form-control lv-form" id="title" name="title" placeholder="Cím..." value="{{ old('title', $record->title ?? null) }}">
</div>
<div class="form-group">
  <label for="type">Típus</label>
  <input type="text" class="form-control lv-form" id="type" name="type" placeholder="CD-DVD-2CD stb..." value="{{ old('type', $record->type ?? null) }}">
</div>
<div class="form-group">
  <label for="year">Kiadás éve</label>
  <input type="text" class="form-control lv-form" id="year" name="year" placeholder="Évszám, ahogy látni szeretnéd az oldalon..." value="{{ old('year', $record->year ?? null)}}">
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
  @if (old('thumbnail') | isset($record))
    @if ($record->thumbnail)  
      <img src="{{ $record->url('thumbnail') }}" alt="...">	
    @else
      <img src="{{ Request::root() }}/images/no_image.png" width="250" height="250" alt="...">
    @endif
  @endif
</div>
<div class="form-group">
  <label>Kép</label>
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