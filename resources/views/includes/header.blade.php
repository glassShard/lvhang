<header class="header-outer d-flex align-items-end">
  <div class="header d-flex align-items-end">
    <div
      class="content d-flex height100 align-items-center align-items-lg-end align-items-md-end  align-items-sm-center justify-content-between">
      <a class="height100" href="{{ route('home') }}">
        <div class="logo-holder">
        <img src="{{ Request::root() }}/images/lv-hang-logo-light.svg" alt="">
        </div>
      </a>

      <div class="hamburger">
        <span></span>
      </div>

      <nav class="nav-bar closed-nav-bar">
        <ul class="nav-bar-list">
          <li class="nav-item"><a href="{{ route('home') }}">KEZDŐLAP</a></li>
          <li class="nav-item"><a href="{{ route('live') }}">ÉLŐ</a></li>
          <li class="nav-item"><a href="{{ route('studio') }}">STÚDIÓ</a></li>
          <li class="nav-item"><a href="{{ route('records.index') }}">KIADÓ</a></li>
          <li class="nav-item"><a href="{{ route('news') }}">HÍREK</a></li>
          <li class="nav-item"><a href="{{ route('contact') }}">KAPCSOLAT</a></li>
        </ul>
      </nav>

      @guest
      @else  
      
        <div class="logged-in-user">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()">{{ Auth::user()->name }}<i class="fontello-pause"></i></a>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
            
          </form>
           
        </div>

      @endguest
    </div>
  </div>
</header>