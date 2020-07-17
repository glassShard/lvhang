@extends('layout')

  @section('head')
    <title>L.V. Hang - Eszköz rögzítése</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      
      <section class="section light">
        <h1>{{ $device->name }} nevű eszköz / csoport módosítása</h1>
        <hr>
        <br>

        <div>
          <form action="{{ route('devices.update', ['device' => $device->id]) }}" class="" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="text" class="form-control lv-form lv-inline mb-1" id="name" name="name" placeholder="Eszköz vagy kategória neve..." value="{{ old('name', $device->name ?? null) }}">

            @if (isset($device->image))
              <div class="form-group mt-4">
                @if ($device->image)  
                  <img src="{{ $device->url('image') }}" alt="..." width="300">	
                @else
                  <img src="{{ Request::root() }}/images/no_image.png" width="250" height="250" alt="...">
                @endif
              </div>
            @endif

            @if ($imageNeeded === true)
              <br>
              <div class="form-group">
                <label>Csíkkép</label>
                <input type="file" class="form-control-file" id="image" name="image"/>
              </div>
            @endif
          
            <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success"><i class="fontello-floppy"></i></button>

          </form>
          
        </div>

      </section>

    </main>

  @endsection

