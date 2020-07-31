@extends('layout')

  @section('head')
    <title name="L.V. Hang - {{ $new->title }} módosítása"></title>
    <meta name="robots" content="noindex, nofollow">
    @trixassets
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main class="light">
      <section class="section light">

        <h1>{{ $new->title }} módosítása</h1>
        <br>
        <form action="{{ route('news.update', ['news' => $new->id]) }}" method="POST" enctype="multipart/form-data">
          
          @csrf
          @method('PUT')  
          
          @include('news._form')
          
          <button type="submit" class="btn btn-lg btn-success lv-btn"><i class="fontello-floppy"></i></button>
        </form>
      </section>
    </main>
    
  @endsection