@extends('layout')

  @section('head')
    <title>LV Hang - Contact</title>
  @endsection

  @section('content')
  <div class="body-overlay hidden"></div>
  <div class="main-content d-flex flex-column justify-content-start">

    @include('includes.header')

    <main>
      <section class="section feet-intro lv-border">
        <div class="feet-intro-bg content">
          <img class="image" src="./images/lv_telefon1.png" alt="">
          <div class="text1">
            
            <br>
            <h2>Lugosi László</h2>
            <p>(rendezvényszervezés)</p>
            <p><a href="mailto:lvhang@mentha.hu">lvhang@mentha.hu</a></p>
            <p><a href="tel:36209153202">+36 20 915 3202</a></p>
            <br>
            <h2>Válik László</h2>
            <p>(hangtechnika, stúdió, kiadói ügyek)</p>
            <p><a href="mailto:lvhang@mentha.hu">lvhang@mentha.hu</a></p>
            <p><a href="tel:36209388358">+36 20 938 8358</a></p>
            <br>
            <h2>Gere Miklós</h2>
            <p>(rendezvényszervezés, hangtechnika, fénytechnika, színpadtechnika)</p>
            <p><a href="mailto:geremiki@gmail.com">geremiki@gmail.com</a></p>
            <p><a href="tel:36204805939">+36 20 480 5939</a></p>
            <br>
            
          </div>
        </div>
        <div class="clear"></div>
      </section>
    </main>

  @endsection