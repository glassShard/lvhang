@extends('layout')

  @section('head')
    <title name="L.V. Hang - Híreink"></title>
    <meta name="description" content="Az L.V. Hang híroldala">
    <meta name="keywords" content="Az L.V. Hang közelgő munkái, folyamatban lévő felvételei">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="L.V. Hang - Hírek" />
    <meta property="og:description" content="Az L.V. Hang közelgő munkái, folyamatban lévő felvételei" />
    <meta property="og:image" content="{{ Request::root() }}/images/news.jpg" />
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

      <section class="section">
				<div class="content">

          <h1>Híreink
            @auth
              <a href="{{ route('news.create') }}" class="btn btn-lg btn-info lv-btn ml-4"><i class="fontello-doc-new"></i></a>
            @endauth
          </h1>

          <div class="news-wrapper">
            @forelse($news as $new)

              @include('news._news_list')

            @empty
              <p>Még nincsenek hírek</p>
            @endforelse  
        </div>

        <a href="{{ route('angular.view') }}" class="btn-to-price">Árak</a>
      </section>
    </main>
    
  @endsection