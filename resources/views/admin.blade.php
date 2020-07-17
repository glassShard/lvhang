@extends('layout')

  @section('head')
    <title>LV Hang - Admin</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
  <div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section feet-intro lv-border">
        <div class="feet-intro-bg content">
          <a class="btn btn-lg btn-primary btn-normal lv-btn" href="{{ route('records.create') }}">Új kiadvány</a>
          <a class="btn btn-lg btn-primary btn-normal lv-btn" href="{{ route('live-ref-places.index') }}">Élő referencia helyszínek</a>
          <a class="btn btn-lg btn-primary btn-normal lv-btn" href="{{ route('galleries.index') }}">Képgalériák</a>
          <a class="btn btn-lg btn-primary btn-normal lv-btn" href="{{ route('devices.index') }}">Eszközlisták</a>
        </div>
      </section>
    </main>

  @endsection