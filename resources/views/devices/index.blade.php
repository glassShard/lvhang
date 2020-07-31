@extends('layout')

  @section('head')
    <title>L.V. Hang - Eszközök</title>
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
        
        <h1>Eszközlista</h1>
        <hr> 
        @foreach($parentDevices as $device)

        {{-- gyökér kategóriák kirajzolása --}}

          <div class="d-flex">
            
            <form action="{{ route('devices.update', ['device' => $device->id]) }}" class="lv-form-inline" method="POST">

              @csrf 
              @method('PUT')

              <input type="text" class="form-control lv-form lv-inline mb-1" name="name" placeholder="Eszköz vagy kategória neve..." value="{{ $device->name }}">
            
              <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success mb-1 ml-4 mr-1 d-inline-block"><i class="fontello-floppy"></i></button>

            </form>

            <a href="{{ route('devices.create-to-parent', ['parent' => $device->id]) }}" class="btn btn-lg btn-primary lv-btn btn-info mb-1"><i class="fontello-doc-new"></i></a>
          
          </div>

          @if(count($device->subDevice))
            @include('devices._form_subDeviceList', ['subDevices' => $device->subDevice])
          @endif
        <br>
        <hr>
        <br>
        @endforeach


      </section>

    </main>

  @endsection

