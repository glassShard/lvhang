@extends('layout')

  @section('head')
    <title name="L.V. Hang - Élő referenciák"></title>
    @trixassets
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light">

        @if(session()->has('status'))
          <p style="color: green">{{ session()->get('status') }}</p>
        @endif

        <h1 class="d-inline-block mr-4">Élő referenciák a(z) "{{ $liveRefPlace->name}}" nevű helyszínhez</h1>

        <hr>
        <br>
        
        @forelse ($liveRefs as $liveRef) 
          <ul>
            <li class=d-flex >

              <form action="{{ route('live-refs.update', ['live_ref' => $liveRef->id]) }}" class="lv-form-inline" method="POST">

                @csrf 
                @method('PUT')

                <input type="text" class="form-control lv-form lv-inline mb-1" id="performer" name="performer" placeholder="Előadó (referencia) neve..." value="{{ $liveRef->performer }}">
              
                <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success mb-1 ml-4 mr-1 d-inline-block"><i class="fontello-floppy"></i></button>

              </form>
              <form action="{{ route('live-refs.destroy', ['live_ref' => $liveRef->id]) }}" class="" method="POST">
          
                @csrf 
                @method('DELETE')
    
                <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger mb-1"><i class="fontello-trash-1"></i></button>
              
              </form>
            </li>
          </ul>
        @empty
          <p>Nincs még előadó rögzítve.</p>
        @endforelse

        <form action="{{ route('live-refs.store') }}" class="lv-form-inline" method="POST">

          @csrf 

          <input type="text" class="form-control lv-form lv-inline mb-1" id="performer" name="performer" placeholder="Itt rögzíthetsz újat..." value="">

          <input type="hidden" id="liveRefPlace" name="liveRefPlace" value="{{ $liveRefPlace->id }}">
        
          <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success mb-1 ml-4 mr-1 d-inline-block"><i class="fontello-floppy"></i></button>

        </form>

        <br>
      </section>
    </main>
    
  @endsection