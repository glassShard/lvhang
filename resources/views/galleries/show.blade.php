@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $gallery->title }}"></title>
  @endsection

  @section('content')
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
          <hr>
          <br>

          <div class="imagesPreviewContainer">
            @forelse($gallery->galleryImages as $image)
              <div class="galleryImageWrapper">
                <img src="{{ $image->url('thumbnail') }}" alt="" height="120" class="clickableImage">
                
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
    
              <button type="submit" class="btn btn-lg btn-success lv-btn"><i class="fontello-floppy"></i></button>

            </form>
            

          @endauth

          <!-- Swiper -->
          <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
              @foreach($gallery->galleryImages as $image)
                <div class="swiper-slide">
                  <img data-src="{{ $image->url('image') }}" class="swiper-lazy">
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