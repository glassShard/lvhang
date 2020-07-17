<div class="galleryCover">
  <a href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}" class="imgCover">
    @if ($gallery->thumbnail)
      <img src="{{ $gallery->url('thumbnail') }}" class="galleryCoverImage" alt="...">	
    @else
      <img src="{{ Request::root() }}/static-images/no_image.png" class="galleryCoverImage" alt="...">	
    @endif
  </a>

  <a href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}">
    <div class="galleryCoverTitle">
      <p>{{ $gallery->title }}</p>
    </div>
  </a>

  <a href="{{ route('galleries.type', ['type' => $gallery->foot]) }}" class="btn btn-lg lv-btn footButton">
    @if ($gallery->foot === 'live')
      <i class="fontello-volume-up"></i>
    @else
      <i class="fontello-mic"></i>
    @endif
  </a>

  @auth
    <div class="galleryEditButtons">
      <a href="{{ route('galleries.edit', ['gallery' => $gallery->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>

      <form action="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}" class="d-inline-block" method="POST">
      
        @csrf 
        @method('DELETE')

        <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger"><i class="fontello-trash-1"></i></button>
      
      </form>
    </div>
  @endauth  
</div>
