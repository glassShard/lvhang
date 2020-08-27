@extends('layout')

  @section('head')
    <title>L.V. Hang - Élő</title>
    <meta name="description" content="Rendezvények szervezése, hangosítása, fénytechnika, színpadtechnika">
    <meta name="keywords" content="hangtechnika, fénytechnika, színpadtechnika, rendezvények, rendezvények kivitelezése">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="L.V. Hang - Élő" />
    <meta property="og:description" content="Rendezvények szervezése, hangosítása, fénytechnika, színpadtechnika." />
    <meta property="og:image" content="{{ Request::root() }}/images/live.jpg" />
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
          <img class="logo" src="./static-images/LV LIVE_LOGO-01-dark.svg" alt="l.v. live logo">
          <img class="image" src="./static-images/jbl_uj_piros.png" alt="jbl line array">
          <div class="text1">
            <h1 class="lv-display-1">Rendezvények</h1>
            <p>Az L.V. Hang Bt-t 1993-ban azzal az alapvető céllal alapítottuk, hogy rendezvényszervező ügyfeleink részére megbízható, rugalmas technikai hátteret biztosítsunk.</p>
            <p>Professzionális hangtechnikai eszközparkkal rendelkezünk, így fő tevékenységünk a különféle rendezvények teljes körű technikai lebonyolítása (hang-,
              fény-, vizuál-, színpadtechnika). Ez vonatkozhat akár az 50 fős, akár a 6-7000 embert kiszolgáló eseményekre – sportesemények, céges rendezvények, színházi előadások, kisebb - nagyobb koncertek. Szükség esetén fellépők / programok szervezését is vállaljuk.</p>
            <p>Rendszeres közreműködői vagyunk a hazai nagy fesztiváloknak: a Sziget Fesztivál több helyszínének hangosítását tizennyolcadik éve látjuk el, a Magyar Dal napja teljes hanganyagát is mi rögzítettük. A Diósgyőri Kaláka Folkfesztivál teljes körű technikai kivitelezését tizennegyedik éve végezzük. a Paksi Gastroblues Fesztivál teljes technikai hátterének biztosítása több, mint 25, a Lamantin fesztivál hangosítása 20 éve feladatunk, a koncertek soksávos hangrögzítését és utómunkáit az L.V. Hang Studio végzi.</p>
          </div>
        </div>
        <div class="clear"></div>
      </section>

      @include('includes._device_list')

      <section class="section light foot-intro text1 lv-border">
        <div class="content">
          <h2 class="lv-display-2">Fotó, video:
            @auth
              <a href="{{ route('galleries.create', ['studio' => 0]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
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
            @auth
              <a href="{{ route('live-ref-places.index') }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
            @endauth
          </h2>

          <hr>

          @forelse ($liveRefPlaces as $liveRefPlace)
            <ul>
              <li>
                <h2 class="lv-display-3">{{ $liveRefPlace->name }}<h2>
                <p>
                  @foreach($liveRefPlace->liveRefs as $liveRef)
                    <span class="liveRef">{{$liveRef->performer}}</span>
                  @endforeach
                </p>                
              </li>
            </ul>
            
          @empty
            <p>Még nincs referencia</p>
          @endforelse

        </div>

      </section>

    </main>

  @endsection
