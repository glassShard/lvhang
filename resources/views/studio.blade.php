@extends('layout')

  @section('head')
    <title>L.V. Hang - Studio</title>
    <meta name="description" content="L.V. Hang Studio bemutatása, eszközeinek listája, referenciák">
    <meta name="keywords" content="hangfelvételek készítése, keverés, mastering, hangutómunka, koncerfelvételek">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="L.V. Hang Studio" />
    <meta property="og:description" content="Hangfelvételek, koncerfelvételek készítése, keverés, mastering, hangutómunka." />
    <meta property="og:image" content="{{ Request::root() }}/images/studio.jpg" />
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="robots" content="index, follow">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light feet-intro lv-border">
        <div class="feet-intro-bg content">
          <img class="logo" src="./static-images/LV_STUDIO_LOGO-01-dark.svg" alt="l.v. hang studio logo">
          <img class="image" src="./static-images/lv_tape_piros.png" alt="magnószalag">
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
              <a href="{{ route('galleries.create', ['studio' => 1]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
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
          </h2>

          <hr>
          <div class="galleriesWrapper">
             
            @forelse ($referenceGalleries as $gallery)   
                @include('galleries._gallery_cover')
            @empty
              <p>Még nincs fényképalbum</p>
            @endforelse

          </div>

        </div>

      </section>

    </main>

  @endsection
