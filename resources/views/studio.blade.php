@extends('layout')

  @section('head')
    <title>L.V. Hang - Studio</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light feet-intro lv-border">
        <div class="feet-intro-bg content">
          <img class="logo" src="./static-images/LV_STUDIO_LOGO-01-dark.svg" alt="">
          <img class="image" src="./static-images/lv_tape_piros.png" alt="">
          <div class="text1">
            <h1 class="lv-display-1">L.V. Hang Studio</h1>
            <p class=>Stúdiónk három üveggel elválasztott feljátszó helyiségből, kontroll-szobából,
              hangszerszobából és szociális helyiségből áll. Kiválóan alkalmas 4-6 hangszeres együttes játékának
              rögzítésére. A zenészek egyszerre tudnak játszani, mialatt a hangszereik akusztikailag elszeparáltak lehetnek.
              Akár 10 sztereó fejhallgató monitor út is keverhető. A széles eszköz- és mikrofonpark sokféle hangzás
              kialakítását teszi lehetővé. A felvételekre használható egy Mechlabor STM 700 2"-os magnó is, ha igazán
              analóg hangzást akarunk elérni. Általában nagy felbontásban dolgozunk (88,2 vagy 96kHz, 32bit) melyet
              MyTek
              Brooklyn órajellel vezérelt Metric Halo hangkártyával rögzítünk.</p>
          </div>
        </div>
        <div class="clear"></div>
      </section>

      @include('includes._device_list')

      <section class="section light foot-intro text1 lv-border">
        <div class="content">
          <h2 class="lv-display-2">Fotó, video:
            @auth
              <a href="{{ route('galleries.create') }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
            @endauth
          </h2>
          <hr>
            <div class="galleriesWrapper">
             
              @forelse ($galleries as $gallery)   
                  @include('galleries._gallery_cover')
              @empty
                <p>Még nincs fényképalbum</p>
              @endforelse

            </div>
        </div>
        
      </section>

      <section class="section light foot-intro text1">
        <div class="content">
          <h2 class="lv-display-2 d-inline-block">Referenciák:
           {{--  @auth
              <a href="{{ route('live-ref-places.index') }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
            @endauth --}}
          </h2>

          <hr>

          <h2>Felvétel, keverés, mastering</h2>
          <h2>Felvétel</h2>
          <h2>Keverés, mastering</h2>

{{--           @forelse ($liveRefPlaces as $liveRefPlace)
            <ul>
              <li>
                <h2>{{ $liveRefPlace->name }}<h2>
                <p>
                  @foreach($liveRefPlace->liveRefs as $liveRef)
                    <span class="liveRef">{{$liveRef->performer}}</span>
                  @endforeach
                </p>                
              </li>
            </ul>
            
          @empty
            <p>Még nincs referencia</p>
          @endforelse --}}

        </div>

      </section>

    </main>

  @endsection
