@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $gallery->title }}"></title>
    <link rel="stylesheet" href="{{ Request::root() }}/css/swiper-bundle.min.css">
    <meta property="og:title" content="{{ $gallery->title }}" />
    <meta property="og:description" content="Nézd meg képgalériánkat!" />
    <meta property="og:image" content="{{ $gallery->url('fbShareImage') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="Az L.V. Hang képgalériáiból: {{ $gallery->title }}">
    <meta name="keywords" content="{{ $gallery->keywords }}">
  @endsection

  @section('content')
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v7.0" nonce="duHJ3405"></script>
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>

      <section class="section light">
				<div class="content">
          
          @if(session()->has('status'))
            <p style="color: green">{{ session()->get('status') }}</p>
          @endif

          @auth

            <a href="{{ route('galleries.edit', ['gallery' => $gallery->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>

            <form action="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}" class="d-inline-block" method="POST">
            
              @csrf 
              @method('DELETE')

              <button type="submit" class="btn btn-lg btn-primary btn-danger lv-btn"><i class="fontello-trash-1"></i></button>
            
            </form>
            <div class="mb-4"></div>
          @endauth

          {{-- @include('galleries._gallery_cover') --}}
          <h1>{{ $gallery->title }}</h1>
          <br>
          <a target="_blank" class="btn btn-lg btn-normal lv-btn mb-4 fb-share" data-href="{{ Request::root() }}/galleries/{{ $gallery->id }}" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::root() }}/galleries/{{ $gallery->id }}" class="fb-xfbml-parse-ignore"><i class="fontello-facebook-squared"></i> Megosztás</a>
          <hr>
          <br>

          <div class="imagesPreviewContainer">
            @forelse($gallery->galleryImages as $image)
              <div class="galleryImageWrapper" style='opacity:0'>
                <img src="{{ $image->url('thumbnail') }}" height="120" class="clickableImage" alt="{{ $gallery->title }} galéria kép">
                
                @auth
                  <form action="{{ route('gallery-images.delete', ['id' => $image->id]) }}" class="d-inline-block" method="POST">
              
                    @csrf 
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger lv-btn deleteButton"><i class="fontello-trash-1"></i></button>
                  
                  </form>
                @endauth
              </div>
              
            @empty
              <p>Még nincs kép feltöltve ehhez a galériához</p>
            @endforelse
          </div>

          @auth
            
            <h2 class="mt-4">Adj hozzá képeket</h2>

            <form action="{{ route('gallery-images.save-images', ['id' => $gallery->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf  
    
              <div class="form-group">
                <label>Képek</label>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple/>

                @if($errors->has('images'))
                  <span class="invalid-feedback d-block">{{ $errors->first('images') }}</span>
                @endif
              </div>
    
              <button type="submit" class="btn btn-lg btn-success lv-btn"><i class="fontello-floppy"></i></button>

            </form>
            

          @endauth

          <!-- Swiper -->
          <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
              @foreach($gallery->galleryImages as $image)
                <div class="swiper-slide">
                  <img data-src="{{ $image->url('image') }}" class="swiper-lazy" alt="{{ $gallery->title }} galéria kép">
                  <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                </div>
              @endforeach

            </div>

            <div class="swiper-pagination swiper-pagination-white"></div>

            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>

            <button class="btn btn-normal galleryExit"><i class="fontello-cancel"></i></button>
          </div>

        </div>
      </section>
    </main>
    
  @endsection