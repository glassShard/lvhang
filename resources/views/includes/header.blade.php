<header class="header-outer d-flex align-items-end">
  <div class="header d-flex align-items-end">
    <div
      class="content d-flex height100 align-items-center align-items-lg-end align-items-md-end  align-items-sm-center justify-content-between">
      <a class="height100" href="{{ route('home') }}">
        <div class="logo-holder">
        <img src="{{ Request::root() }}/static-images/lv-hang-logo-light.svg" alt="">
        </div>
      </a>

      <div class="hamburger">
        <span></span>
      </div>

      <nav class="nav-bar closed-nav-bar">
        <ul class="nav-bar-list">
          <li class="nav-item"><a href="{{ route('home') }}"><span>KEZDŐLAP</span></a></li>
          <li class="nav-item"><a href="{{ route('live.index') }}"><span>ÉLŐ</span></a></li>
          <li class="nav-item"><a href="{{ route('studio.index') }}"><span>STÚDIÓ</span></a></li>
          <li class="nav-item"><a href="{{ route('records.index') }}"><span>KIADÓ</span></a></li>
          <li class="nav-item"><a href="{{ route('news.index') }}"><span>HÍREK</span></a></li>
          <li class="nav-item"><a href="{{ route('contact') }}"><span>KAPCSOLAT</span></a></li>
        </ul>
      </nav>

      @guest
      @else  
      
        <div class="logged-in-user">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()">{{ Auth::user()->name }} <i class="fontello-logout"></i></a>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
            
          </form>
           
        </div>

      @endguest
    </div>
  </div>
</header>