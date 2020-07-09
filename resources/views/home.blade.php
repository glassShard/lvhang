@extends('layout')

  @section('head')
  <title>LV Hang - Kezdőlap</title>
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
              <a class="intro-link" href="{{ route('studio') }}">
                <div class="intro-text">
                  KONCERT FELVÉTEL KÉSZÍTÉS
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('studio') }}">
                <div class="intro-text">
                  HANGFELVÉTEL KÉSZÍTÉS
                </div>
                <div class="intro-arrow">
                  <i class="fontello-play"></i>
                </div>
              </a>
            </li>
            <li class="intro-list-item">
              <a class="intro-link" href="{{ route('studio') }}">
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
              <a href="#" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                  rgba(0,0,0,0.7), 
                  rgba(0,0,0,0.7)),url('images/IMG_3886.jpg')">
                  <div class="lv-card-logo">
                    <img src="images/LV LIVE_LOGO-01.svg" class="card-img-top lv-card-logo-img" alt="...">
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
                <a href="#" class="btn btn-lg btn-primary btn-normal">Tovább az élőre</a>
              </div>
            </div>
            
            <div class="card lv-card">
              <a href="#" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                rgba(0,0,0,0.7), 
                rgba(0,0,0,0.7)),url('images/IMG_20200615_165554.jpg')">
                  <div class="lv-card-logo">
                    <img src="images/LV_STUDIO_LOGO-01.svg" class="card-img-top lv-card-logo-img" alt="...">
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
                <a href="#" class="btn btn-lg btn-primary btn-normal">Tovább a stúdióra</a>
              </div>
            </div>
  
            <div class="card lv-card">
              <a href="#" class="lv-card-image-link">
                <div class="lv-card-title-row" style="background-image:linear-gradient(
                  rgba(0,0,0,0.7), 
                  rgba(0,0,0,0.7)),url('images/kiado.jpg')">
                  <div class="lv-card-logo">
                    <img src="images/LV _REC_LOGO-01.svg" class="card-img-top lv-card-logo-img" alt="...">
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
                <a href="#" class="btn btn-lg btn-primary btn-normal">Tovább a kiadóra</a>
              </div>
            </div>
  
          </div>
        </div>
      </section>
      
      <p>
  
      </p>
    </main>
  @endsection
