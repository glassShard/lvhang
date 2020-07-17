@extends('layout')

  @section('head')
    <title>LV Hang - Login</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
  <div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section feet-intro lv-border">
        <h1>Login</h1>
        <br>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
              <label for="email">Cím</label>
              <input type="text" class="form-control lv-form{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email címed..." value="{{ old('email', $record->title ?? null) }}">

              @if($errors->has('email'))
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
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
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" value="{{ old('remember' ? 'checked' : '') }}">

                <label for="remember" class="form-check-label">Emlékezz rám</label>
              </div>

            <br>
            <br>

            <button type="submit" class="btn btn-lg btn-primary btn-normal lv-btn">Login</button>

        </form>
      </section>
    </main>

  @endsection