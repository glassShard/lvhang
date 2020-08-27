@extends('layout')

  @section('head')
		<title>L.V. Hang - Ezt nem találjuk...</title>
		<meta name="robots" content="noindex, nofollow">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

		<main>
			<section class="section">
				<div class="content p404">
          <h1 class="mb-4">Ez az oldal nem találtatik...</h1>
					<a class="btn btn-lg btn-normal lv-btn mt-4" href="{{ route('home') }}">Főoldalra</a>
				</div>
				<div class="clear"></div>
			</section>

			
			</section>

		</main>
  @endsection
