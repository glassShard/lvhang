@extends('prices._angular')

  @section('head')
    <title>L.V. Hang - Árak</title>
    <meta name="robots" content="noindex, nofollow">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
         
      <app-root></app-root>
      
      <div id="token" style="display: none">{{ $user }}</div>
        
    </main>

  @endsection


