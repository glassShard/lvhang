@extends('layout')

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
        
        <h1>
          Árak
          <button href="#" class="btn btn-primary lv-btn btn-info btn-price ml-3"><i class="fontello-doc-new"></i></button>
        </h1>
        
        <hr>
        <ul>          
          @foreach($prices as $price)
            <li>
              <ul>
                @include('prices._form_subPriceList', ['subPrices' => [$price]])
              <hr>
              </ul>
            </li>
          @endforeach
        </ul>
        
      </section>

    </main>

  @endsection

