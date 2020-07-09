@extends('layout')

  @section('head')
    <title name="L.V. Hang - Élő referenciahelyszín hozzáadása"></title>
    @trixassets
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light">

        @include('includes.adminButton')

        <h1>Élő referencia helyszín módosítása</h1>
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

        <form action="{{ route('live-ref-places.update', ['live_ref_place' => $liveRefPlaceToEdit->id]) }}" method="POST">
          
          @csrf
          @method('PUT')  
          
          @include('liveReferences.liveRefPlaces._form')

          <button type="submit" class="btn btn-lg btn-primary btn-normal lv-btn">Mehet</button>
        </form>
      </section>
    </main>
    
  @endsection