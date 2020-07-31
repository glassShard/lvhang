@extends('layout')

  @section('head')
    <title name="L.V. Hang - Új galéria hozzáadása"></title>
    <meta name="robots" content="noindex, nofollow">

  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section light">

        <h1>Új galéria</h1>
        <br>
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
          @csrf  

          @include('galleries._form')

          <button type="submit" class="btn btn-lg btn-success lv-btn"><i class="fontello-floppy"></i></button>
        </form>
      </section>
    </main>
    
  @endsection