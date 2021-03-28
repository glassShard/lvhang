@extends('layout')

  @section('head')
  <title>L.V. Hang - Kezdőlap</title>
  <meta name="description" content="L.V. Hang bemutatkozása, tevékenységek leírása">
  <meta name="keywords" content="hangtechnika, hangfelvétel, mastering, fénytechnika, színpadtechnika, rendezvények, rendezvények kivitelezése">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="L.V. Hang" />
  <meta property="og:description" content="Hang-, fény-, színpadtechnika, stúdió munkák." />
  <meta property="og:image" content="{{ Request::root() }}/images/home.jpg" />
  <meta property="og:type" content="website" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta name="robots" content="index, follow">
  @endsection

  @section('content')
    <div class="body-overlay hidden"></div>
    <div class="home-header d-flex flex-column">
      <div class="header-outer  d-flex align-items-end">
        
        @include('includes.header')

      </div>
  
      <div class="intro">
        <div class="link-box">
          <div class="content-clone"></div>
          <div class="content-overlay"></div>
          <ul class="intro-list">
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('live.index') }}">
                <div class="intro-text">
                  RENDEZVÉNY SZERVEZÉS
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('live.index') }}">
                <div class="intro-text">
                  RENDEZVÉNY KIVITELEZÉS  
                  <span class="subtitle">(HANG-, FÉNY-, SZÍNPADTECHNIKA)</span>
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play ml-0 mr-0"></i>
                </div>	
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('studio.index') }}">
                <div class="intro-text">
                  KONCERT FELVÉTEL KÉSZÍTÉS
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('studio.index') }}">
                <div class="intro-text">
                  HANGFELVÉTEL KÉSZÍTÉS
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('studio.index') }}">
                <div class="intro-text">
                  HANGUTÓMUNKA
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('records.index') }}">
                <div class="intro-text">
                  KIADÓI TEVÉKENYSÉG
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  
    <main>
      <section class="section">
        <div class="content">
          <div class="card-deck lv-card-deck">
            
            <div class="card lv-card">
              <a href="{{ route('live.index') }}" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                  rgba(0,0,0,0.7), 
                  rgba(0,0,0,0.7)),url('static-images/IMG_3886.jpg')">
                  <div class="lv-card-logo">
                    <img src="static-images/lvhang_LOGOK2020-hang-feher-fent.svg?v=1" class="card-img-top lv-card-logo-img" alt="l.v. hang élő logo">
                  </div>
                  <div class="lv-card-title">
                    <h5 class="card-title display">Élő</h5>
                  </div>
                </div>
              </a>	
  
              <div class="card-body lv-card-body">
                <p class="card-text">Rendezvények teljeskörű kivitelezése. Fény-, hang-, színpadtechnika, programszervezés. Fesztiválok, koncertek, céges rendezvények, stb.</p>
              </div>
              
              <div class="card-footer lv-card-footer">
                <a href="{{ route('live.index') }}" class="btn btn-lg btn-primary btn-normal lv-btn">Tovább az élőre</a>
              </div>
            </div>
            
            <div class="card lv-card">
              <a href="{{ route('studio.index') }}" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                rgba(0,0,0,0.7), 
                rgba(0,0,0,0.7)),url('static-images/IMG_20200615_165554.jpg')">
                  <div class="lv-card-logo">
                    <img src="static-images/lvhang_LOGOK2020-studio-feher.svg?v=1" class="card-img-top lv-card-logo-img" alt="l.v. hang studio logo">
                  </div>
                  <div class="lv-card-title">
                    <h5 class="card-title display">Stúdió</h5>
                  </div>
                </div>
              </a>
    
              <div class="card-body lv-card-body">
                <p class="card-text">Hangfelvétel készítés, hangutómunka (keverés, mastering), koncertfelvételek rögzítése, keverése, stb.</p>
              </div>
              
              <div class="card-footer lv-card-footer">
                <a href="{{ route('studio.index') }}" class="btn btn-lg btn-primary btn-normal lv-btn">Tovább a stúdióra</a>
              </div>
            </div>
  
            <div class="card lv-card">
              <a href="{{ route('records.index') }}" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                  rgba(0,0,0,0.7), 
                  rgba(0,0,0,0.7)),url('static-images/kiado.jpg')">
                  <div class="lv-card-logo">
                    <img src="static-images/lvhang_LOGOK2020-records-feher.svg?v=1" class="card-img-top lv-card-logo-img" alt="l.v. records logo">
                  </div>
                  <div class="lv-card-title">
                  <h5 class="card-title display">Kiadó</h5>
                  </div>
                </div>
              </a>						
  
              <div class="card-body lv-card-body">
                <p class="card-text">Az L.V. Records által támogatott zenekarok kiadványainak gondozása (CD, DVD, vinyl).</p>
                
              </div>
              <div class="card-footer lv-card-footer">
                <a href="{{ route('records.index') }}" class="btn btn-lg btn-primary btn-normal lv-btn">Tovább a kiadóra</a>
              </div>
            </div>
  
          </div>
        </div>
      </section>

      <a href="{{ route('angular.view') }}" class="btn-to-price">Árak</a>
    </main>
  @endsection
