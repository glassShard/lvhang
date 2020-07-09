@extends('layout')

  @section('head')
    <title name="L.V. Hang - Élő referencia helyszínek"></title>
    @trixassets
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light">

        @include('includes.adminButton')

        @if(session()->has('status'))
          <p style="color: green">{{ session()->get('status') }}</p>
        @endif

        <h1 class="d-inline-block mr-4">Élő referencia helyszínek
          <a href="{{ route('live-ref-places.create') }}" class="btn btn-lg btn-primary btn-normal lv-btn"><i class="fontello-doc-new"></i></a>
        </h1>
        
        <hr>
        <br>
        
        @forelse ($liveRefPlaces as $liveRefPlace) 
          <ul>
            <li>
              
              <a href="{{ route('live-ref-places.edit', ['live_ref_place' => $liveRefPlace->id]) }}" class="btn btn-lg btn-primary btn-normal lv-btn mb-1"><i class="fontello-pencil"></i></a>

              <form action="{{ route('live-ref-places.destroy', ['live_ref_place' => $liveRefPlace->id]) }}" class="d-inline-block" method="POST">
          
                @csrf 
                @method('DELETE')
    
                <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger mb-1"><i class="fontello-trash-1"></i></button>
              
              </form>

              <a href="{{ route('live-ref-list', ['id' => $liveRefPlace->id]) }}" class="btn btn-lg btn-primary btn-normal lv-btn mb-1"><i class="fontello-doc-new"></i></a>
              
              <h2 class="d-inline-block ml-4" >{{ $liveRefPlace->name }}</h2>
            </li>
          </ul>
        @empty
          <p>Nincs még csoport.</p>
        @endforelse

        <br>
      </section>
    </main>
    
  @endsection