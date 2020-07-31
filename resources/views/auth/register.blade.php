@extends('layout')

  @section('head')
    <title name="L.V. Hang - Regisztráció"></title>
    <meta name="robots" content="noindex, nofollow">
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
	<div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section">
        <h1>Regisztráció</h1>
        <br>

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control lv-form{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Neved..." value="{{ old('name', $record->performer ?? null) }}">

            @if($errors->has('name'))
              <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="email">Cím</label>
            <input type="text" class="form-control lv-form{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email címed..." value="{{ old('email', $record->title ?? null) }}">

            @if($errors->has('email'))
            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
          @endif
          </div>
          <div class="form-group">
            <label for="secret">Titok</label>
            <input type="password" class="form-control lv-form{{ $errors->has('secret') ? ' is-invalid' : '' }}" id="secret" name="secret" placeholder="Titkos kifejezés...">

            @if($errors->has('secret'))
            <span class="invalid-feedback">{{ $errors->first('secret') }}</span>
          @endif
          </div>
          <div class="form-group">
            <label for="password">Jelszó</label>
            <input type="password" class="form-control lv-form{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Jelszó...">

            @if($errors->has('password'))
            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
          @endif
          </div>
          <div class="form-group">
            <label for="password_confirmation">Jelszó újra</label>
            <input type="password" class="form-control lv-form" id="password_confirmation" name="password_confirmation" placeholder="Megint jelszó...">
          </div>
          <br>
          <br>

          <button type="submit" class="btn btn-lg btn-primary btn-normal lv-btn">Regisztrálok</button>
        </form>
      </section>
    </main>

  @endsection