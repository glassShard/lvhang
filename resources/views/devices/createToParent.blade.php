@extends('layout')

  @section('head')
    <title>L.V. Hang - Eszköz rögzítése</title>
    <meta name="robots" content="noindex, nofollow">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      
      <section class="section light">
        <h1>Eszköz rögzítése a(z) {{ $parent->name }} nevű csoportba</h1>
        <hr>
        <br>

        <div>
          <form action="{{ route('devices.store-to-parent', ['parent' => $parent->id]) }}" class="" method="POST" enctype="multipart/form-data">

            @csrf 

            <input type="text" class="form-control lv-form lv-inline mb-1{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Eszköz vagy kategória neve..." value="{{ old('name') }}">

            @if($errors->has('name'))
              <span class="invalid-feedback d-block">{{ $errors->first('name') }}</span>
            @endif

            @if ($imageNeeded === true)
              <br>
              <div class="form-group">
                <label>Csíkkép</label>
                <input type="file" class="form-control-file" id="image" name="image"/>

                @if($errors->has('image'))
                  <span class="invalid-feedback d-block">{{ $errors->first('imgae') }}</span>
                @endif
              </div>
            @endif
            <br>
          
            <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success"><i class="fontello-floppy"></i></button>

          </form>
          
        </div>

      </section>

    </main>

  @endsection

