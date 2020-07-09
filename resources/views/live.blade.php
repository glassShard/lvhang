@extends('layout')

  @section('head')
    <title>L.V. Hang - Élő</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light feet-intro lv-border">
        <div class="feet-intro-bg content">
          <img class="logo" src="../images/LV LIVE_LOGO-01-dark.svg" alt="">
          <img class="image" src="../images/VTX1.png" alt="">
          <div class="text1">
            <h1 class="lv-display-1">Rendezvények</h1>
            <p>Az L.V. Hang Bt. rendezvények, koncertek, partyk teljes körő technikai kivitelezését vállalja (hang-,
              fény-, vizuál-, színpadtechnika). Szükség esetén fellépők szervezését is meg tudjuk oldani.</p>
          </div>
        </div>
        <div class="clear"></div>
      </section>
      <section class="section light lv-border">
        <div class="foot-intro-bg content">
          <div class="list text1">
            <h2 class="lv-display-2">Eszközlista:</h2>

            <hr>
            <h3 class="mb-4 mt-4">Hangtechnika</h3>
            <p>-JBL VTX Nagyformátumú Line Array hangrendszer</p>
            <p>-JBL M22 Monitor rendszer</p>
            <p>-JBL F12, F18, PRX 612m Többfunkciós hangfalak</p>
            <p>-JBL PRX515 többfunkciós hangfalak</p>
            <p>-HK Audio Cohedra Line Array hangrendszer</p>
            <p>-HK Audio CT, SM Monitor Rendszer</p>
            <p>-HK Audio T-series, CT series, Linear Pro Series többfunkciós hangfalak</p>
            <p>-HK Audio R-series Tölcséres Hangsugárzó Rendszer</p>
            <h4>-Keverõpultok</h4>
            <p>Yamaha PM1D, Yamaha DM2000, Yamaha DM1000, Yamaha M7CL, Yamaha LS9, Yamaha PM4000</p>
            <p>Avid SC48</p>
            <p>Soundcraft SM20</p>
            <p>Midas Venice 320</p>
            <p>Target Q Series</p>
            <p>Mikrofonpark (Shure, AKG, Audix, Beyer Dynamic, Sennheiser, Neumann, DPA, stb.)</p>

            <hr>
            <h3 class="mb-4 mt-4">Fénytechnika:</h3>
            <h4>-Mozgófejes lámpák:</h2>
              <p>High End Studio Spot</p>
              <p>High End Studio Color</p>
              <p>DTS XR7</p>
              <h4>-Led PAR</h4>
              <p>RGBW ledpar</p>
              <h4>- PAR lámpák</h4>
              <p>PAR64</p>
              <p>PAR65</p>
              <h4>-Fényvezérlõ</h4>
              <p>Avolites</p>
              <p>Chamsys</p>

              <hr>
              <h3 class="mb-4 mt-4">Színpadtechnika</h3>
              <p>-Evo Stage 1000</p>
              <p>-Global Truss roofs (11x9m, 11x7.5m, 8x6m, 6x4m)</p>


          </div>
        </div>
      </section>

      <section class="section light foot-intro text1 lv-border">
        <div class="content">
          <h2 class="lv-display-2">Fotó, video:</h1>
        </div>
        
      </section>

      <section class="section light foot-intro text1">
        <div class="content">
          <h2 class="lv-display-2 d-inline-block">Referenciák:
            @auth
              <a href="{{ route('live-ref-places.index') }}" class="btn btn-lg btn-primary btn-normal lv-btn"><i class="fontello-doc-new"></i></a>
            @endauth
          </h1>

          <hr>

          @forelse ($liveRefPlaces as $liveRefPlace)
            <ul>
              <li>
                <h2>{{ $liveRefPlace->name }}<h2>
                <p>
                  @foreach($liveRefPlace->liveRefs as $liveRef)
                    {{$liveRef->performer}},
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
