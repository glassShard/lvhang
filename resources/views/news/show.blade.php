@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $new->title }}"></title>
    <meta property="og:title" content="{{ $new->title }}" />
    <meta property="og:description" content="L.V. Hang - Legfrissebb hírünk" />
    <meta property="og:image" content="{{ $new->url('fbShareImage') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="description" content="Az L.V. Hang híreiből: {{ $new->title }}">
    <meta name="keywords" content="{{ $new->keywords }}">
    <meta name="robots" content="index, follow">
  @endsection

  @section('content')
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v7.0" nonce="duHJ3405"></script>
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>

      <section class="section">
				<div class="content">
          
          @if(session()->has('status'))
            <p style="color: green">{{ session()->get('status') }}</p>
          @endif

          <div class="news-header">
            <div class="news-title">
              @auth
                <div class="adminButtons mb-4">
                  <a href="{{ route('news.edit', ['news' => $new->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>
            
                  <form action="{{ route('news.destroy', ['news' => $new->id]) }}" class="d-inline-block" method="POST">
                  
                    @csrf 
                    @method('DELETE')
            
                    <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger"><i class="fontello-trash-1"></i></button>
                  
                  </form>
                </div>
              @endauth
              
              <h1 class="lv-display-2">{{ $new->title }}</h1>
              <p class="text-muted text-italic">Közzétéve: {{ $new->created_at->diffForHumans() }}</p>

              <a target="_blank" class="btn btn-lg btn-normal lv-btn mb-4 fb-share" data-href="{{ Request::root() }}/news/{{ $new->id }}" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::root() }}/news/{{ $new->id }}" class="fb-xfbml-parse-ignore"><i class="fontello-facebook-squared"></i> Megosztás</a>
              
              <div class="borderDiv"></div>
            
            </div>
            <div class="news-cover">
              @if ($new->cover)
                <img src="{{ $new->url('cover') }}" class="card-img-top" alt="{{ $new->title }} borítókép">	
              @else
                <img src="{{ Request::root() }}/static-images/no_image.png" class="card-img-top" alt="nincs kép kép">	
              @endif
            </div>

            @if (isset($new->trixRichText))
              <div class="news-content">
                @foreach($new->trixRichText as $content)
                  {!! $content->content !!}
                @endforeach
              </div>
            @endif
            
            @if (isset($gallery))
              <div class="news-gallery">
                @include('galleries._gallery_cover')
              </div>
            @endif

            @if (isset($new->video))
              <div class="news-video">
                <iframe src="{{ $new->video }}"
                frameborder="0" allowfullscreen></iframe>
              </div>
            @endif
            
            
          </div>
        </div>
      </section>

    </main>
    
  @endsection