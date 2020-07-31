<div class="news-item-wrapper">
  <a href="{{ route('news.show', ['news' => $new->id]) }}">
    <div class="media lv-media">
      <img src="{{ $new->url('thumbnail') }}" alt="{{ $new->title }} borítókép">
      <div class="media-body lv-media-body">
        <h2 class="mt-1 xs-text-center">{{ $new->title }} <span class="small text-muted text-italic"> - Közzétéve {{ $new->created_at->diffForHumans() }}</span></h2>
        <p class="text-muted xs-text-center">
          @if (isset($new->gallery_id))
            @if ($new->gallery_id !== 0)
              <i class="fontello-picture"></i>
            @endif
          @endif

          @if (isset($new->video))
            <i class="fontello-video"></i>
          @endif
        </p>
      </div>
    </div>
  </a>
  @auth
    <div class="adminButtons">
      <a href="{{ route('news.edit', ['news' => $new->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>

      <form action="{{ route('news.destroy', ['news' => $new->id]) }}" class="d-inline-block" method="POST">
      
        @csrf 
        @method('DELETE')

        <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger"><i class="fontello-trash-1"></i></button>
      
      </form>
    </div>
  @endauth
</div>
  
