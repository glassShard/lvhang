@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $record->performer }} - {{ $record->title }}"></title>
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
                @foreach($record->trixRichText as $content)
                  {!! $content->content !!}
                @endforeach
              </div>
              
            </div>
            <div class="half">
              <div class="cover">
                @if ($record->image)
                  <img src="{{ $record->url('image') }}" class="card-img-top" alt="...">	
                @else
                  <img src="{{ Request::root() }}/static-images/no_image.png" class="card-img-top" alt="...">	
                @endif
              </div>
              
            </div>
          </div>
          
          

        </div>
      </section>
    </main>
    
  @endsection