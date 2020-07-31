@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $record->performer }} - {{ $record->title }}"></title>
    <meta property="og:title" content="{{ $record->performer }} - {{ $record->title }}" />
    <meta property="og:description" content="L.V. Records - Kiadványaink" />
    <meta property="og:image" content="{{ $record->url('fbShareImage') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="description" content="Ez is az L.V. Records kiadványa: {{ $record->performer }} - {{ $record->title }}">
    <meta name="keywords" content="{{ $record->keywords }}">
    <meta name="robots" content="index, follow">
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

          <div class="d-flex flex-wrap">
            <div class="half">
              <div class="blabla">
                @auth

                  <a href="{{ route('records.edit', ['record' => $record->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>

                  <form action="{{ route('records.destroy', ['record' => $record->id]) }}" class="d-inline-block" method="POST">
                  
                    @csrf 
                    @method('DELETE')

                    <button type="submit" class="btn btn-lg btn-primary btn-danger lv-btn"><i class="fontello-trash-1"></i></button>
                  
                  </form>
                  <div class="mb-4"></div>
                @endauth

                <h1 class="lv-display-2">{{ $record->performer }}</h1>
                <h2 class="lv-display-2">{{ $record->title }}</h2>
                <hr>

                <h2>{{ $record->type }} - {{ $record->year }}</h2>
                <br>
                <a target="_blank" class="btn btn-lg btn-normal lv-btn mb-4 fb-share" data-href="{{ Request::root() }}/records/{{ $record->id }}" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::root() }}/records/{{ $record->id }}" class="fb-xfbml-parse-ignore"><i class="fontello-facebook-squared"></i> Megosztás</a>

                @foreach($record->trixRichText as $content)
                  {!! $content->content !!}
                @endforeach
              </div>
              
            </div>
            <div class="half">
              <div class="cover">
                @if ($record->image)
                  <img src="{{ $record->url('image') }}" class="card-img-top" alt="{{ $record->title }} borítókép">	
                @else
                  <img src="{{ Request::root() }}/static-images/no_image.png" class="card-img-top" alt="nincs kép kép">	
                @endif
              </div>
              
            </div>
          </div>
          
          

        </div>
      </section>
    </main>
    
  @endsection