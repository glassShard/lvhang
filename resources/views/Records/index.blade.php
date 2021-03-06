@extends('layout')

  @section('head')
		<title>L.V. Hang - Kiadványok</title>
		<meta name="description" content="Az L.V. Records kiadványai">
    <meta name="keywords" content="kiadvány, kiadás, jazz, kortárs, progresszív, noise, CD, vinyl, experimantal">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="L.V. Records" />
    <meta property="og:description" content="CD, Vinyl, DVD kiadványok." />
    <meta property="og:image" content="{{ Request::root() }}/images/records.jpg" />
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
{{-- 					<img class="logo" src="./static-images/lvhang_LOGOK2020-records-fekete.svg" alt="l.v. records logo"> --}}
					<img class="image" src="./static-images/lv_vinyl_piros.png" alt="vinyl hanglemez">
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
							<a href="{{ route('records.create') }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-doc-new"></i></a>
						@endauth
					
					</h2>
            
						<br>

					<div class="record-card-wrapper d-flex">
              
              @foreach ($records as $record)
                <div class="card record">
									<a href="{{ route('records.show', ['record' => $record->id]) }}">
										
										@if ($record->thumbnail)
											<img src="{{ $record->url('thumbnail') }}" class="card-img-top" alt="{{ $record->title }} borító">	
										@else
											<img src="./images/no_image.png" class="card-img-top" alt="nincs kép kép">	
										@endif
										
									</a>  
									<a class="card-body record-card-body" href="{{ route('records.show', ['record' => $record->id]) }}">

                      <p class="card-title">{{ $record->performer }}</p>
                      <p class="card-text">{{ $record->title }}</p>
                      <p class="card-text">{{ $record->type }} - {{ $record->year }}</p>
									</a>
										@auth
											<div class="card-footer">
												<a href="{{ route('records.edit', ['record' => $record->id]) }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>

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
