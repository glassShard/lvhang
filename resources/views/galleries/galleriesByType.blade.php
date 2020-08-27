@extends('layout')

  @section('head')
    <title name="L.V. Hang - Képgalériák"></title>
    <meta name="robots" content="index, follow">
    <meta name="description" content="Az L.V. Hang képgalériáiból: {{ $type }}">
    <meta name="keywords" content="képek, {{ $type }}">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>

      <section class="section light">
				<div class="content">

          <h1>Képgalériák - {{ $type }}
            @auth
              <a href="{{ route('galleries.create', ['studio' => 0]) }}" class="btn btn-lg btn-info lv-btn ml-4"><i class="fontello-doc-new"></i></a>
            @endauth
          </h1>
          <hr>

          <div class="record-card-wrapper d-flex">
            @forelse($galleries as $gallery)

              @include('galleries._gallery_cover')

            @empty
              <p>Még nincsenek galériák</p>
            @endforelse  
        </div>
      </section>
    </main>
    
  @endsection