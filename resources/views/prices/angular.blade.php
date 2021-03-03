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
      
      <section class="section light lv-border">
        @if(session()->has('status'))
          <p style="color: green">{{ session()->get('status') }}</p>
        @endif
        
        <app-root></app-root>
       
        <div id="token" style="display: none">{{ $user }}</div>
        
      </section>

    </main>

  @endsection


