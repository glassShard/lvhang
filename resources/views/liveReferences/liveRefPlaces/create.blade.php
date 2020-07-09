@extends('layout')

  @section('head')
    <title name="L.V. Hang - Új élő referenciacsoport hozzáadása"></title>
    @trixassets
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light">

        @include('includes.adminButton')

        <h1>Új élő referenciacsoport</h1>
        <br>
        <h2>Meglévő csoportok:</h2>
        
        @forelse ($liveRefPlaces as $liveRefPlace) 
          <ul>
            <li>{{ $liveRefPlace->name }}</li>
          </ul>
        @empty
          <p>Nincs még csoport.</p>
        @endforelse

        <br>

        <form action="{{ route('live-ref-places.store') }}" method="POST">
          @csrf  

          @include('liveReferences.liveRefPlaces._form')

          <button type="submit" class="btn btn-lg btn-primary btn-normal">Mehet</button>
        </form>
      </section>
    </main>
    
  @endsection