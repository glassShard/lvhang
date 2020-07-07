@extends('layout')

  @section('head')
    <title>L.V. Hang - Kiadványok</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

		<main>
			<section class="section light feet-intro lv-border">
				<div class="feet-intro-bg content">
					<img class="logo" src="./images/LV _REC_LOGO-01-dark.svg" alt="">
					<img class="image" src="./images/lv_vinyl_piros.png" alt="">
					<div class="text1">
						<h1 class="lv-display-1">L.V. Records</h1>
						<p>Az L.V. Records tevékenységének fő célja a hazai kísérleti, progresszív, kortárs, jazz határmezsgyéjén
							működő zenekarok koncert és studio felvételeinek gondozása és megjelentetése. A kiadott zenék jelentős
							része markáns esztétikai stílust képvisel, másrészt néhány barát hanganyaga is kiadásra kerül(t).
							Az L.V.Records külföldre is eljuttatja albumait, elsősorban a <a href="http://www.perifericrecords.com">Stereo KFT.</a> segítségével. Szinte kizárólag
							az L.V.Hang Studio munkáit hallhatjuk a kiadványokon.
							Az ONLINE terjesztés is megoldott, a dalok.hu segítségével, de Facebook oldalon is megtekinthető néhány
							érdekesség. Készül az L.V. Records youtube csatornája is, ahol sok eddig be sem mutatott koncertfelvétel is
							látható lesz.
						</p>
					</div>
				</div>
				<div class="clear"></div>
			</section>

			<section class="section light foot-intro text1">
				<div class="content">
          <h2 class="lv-display-2">Kiadványok:
						
						@auth
							<a href="{{ route('records.create') }}" class="btn btn-lg btn-primary btn-normal lv-btn"><i class="fontello-doc-new"></i></a>
						@endauth
					
					</h2>
            
						<br>

					<div class="record-card-wrapper d-flex">
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kadacsinvat_web-th.png" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada</p>
									<p>Csinvat</p>
									<p class="card-text">Vynil - 2019</p>									
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/ZENMALAC_th.png" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Eichinger Trio</p>
									<p class="card-text">Zenmalac és a többiek</p>
									<p class="card-text">CD - 2019</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kadainvivocover-th.png" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada Ad Libitum</p>
									<p class="card-text">In Vivo</p>
									<p class="card-text">Vynil - 2016</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/eichWEBbig-17-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Eichinger Trio</p>
									<p class="card-text">A legöregebb Bambi lovag</p>
									<p class="card-text">CD - 2018</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/CONTEMPO_web-th.png" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Contempo</p>
									<p class="card-text">Appassionato</p>
									<p class="card-text">CD - 2019</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/brezo-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Brezó Quartet</h5>
									<p class="card-text">Illesztések</p>
									<p class="card-text">CD - 2007</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/bucsuzas-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada</p>
									<p class="card-text">Búcsúzás</p>
									<p class="card-text">2CD - 2002</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/forestflowerWEBbig-11-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">East 2 East</p>
									<p class="card-text">Forest Flower</p>
									<p class="card-text">2CD - 2018</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kada-ohoae-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada</h5>
									<p class="card-text">Ohoáéib</p>
									<p class="card-text">CD - 2003</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kada-ufo-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada</p>
									<p class="card-text">UFO nézők</p>
									<p class="card-text">DVD - 2006</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kal-approx-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada Ad Libitum</p>
									<p class="card-text">Approximationes</p>
									<p class="card-text">CD - 2006</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kal-progr-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada Ad Libitum</p>
									<p class="card-text">Progressio, Inflexio, Repetitio</p>
									<p class="card-text">CD - 2008</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/kal-tavol-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Kada Ad Libitum</p>
									<p class="card-text">Távolbanézés</p>
									<p class="card-text">3CD - 2015</p>	
								</div>
							</div>
							<div class="card record">
								<img src="./images/kiadvanyok/thumbnail/korog-th.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-title">Korog</p>
									<p class="card-text">Maybe Airline</p>
									<p class="card-text">Vynil - 2014</p>	
								</div>
              </div>
              
              @foreach ($records as $record)
                <div class="card record">
										<a href="{{ route('records.show', ['record' => $record->id]) }}">
											
											@if ($record->thumbnail)
												<img src="{{ $record->url('thumbnail') }}" class="card-img-top" alt="...">	
											@else
												<img src="./images/no_image.png" class="card-img-top" alt="...">	
											@endif
                      
                    </a>  
										<a href="{{ route('records.show', ['record' => $record->id]) }}">
										<div class="card-body record-card-body">
                      <p class="card-title">{{ $record->performer }}</p>
                      <p class="card-text">{{ $record->title }}</p>
                      <p class="card-text">{{ $record->type }} - {{ $record->year }}</p>
                      	
                    </div>
									</a>
										@auth
											<div class="card-footer">
												<a href="{{ route('records.edit', ['record' => $record->id]) }}" class="btn btn-lg btn-primary btn-normal lv-btn"><i class="fontello-pencil"></i></a>

												<form action="{{ route('records.destroy', ['record' => $record->id]) }}" class="d-inline-block" method="POST">
												
													@csrf 
													@method('DELETE')

													<button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger"><i class="fontello-trash-1"></i></button>
												
												</form>
											</div>
										@endauth
                  </div>
                  
              @endforeach

					</div>
				</div>

			</section>

		</main>
  @endsection
