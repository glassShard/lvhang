<section class="section light lv-border">
  <div class="foot-intro-bg content">
    <div class="list text1">
      <h2 class="lv-display-2">Eszközlista:
        @auth
          <a href="{{ route('devices.index') }}" class="btn btn-lg btn-info lv-btn"><i class="fontello-pencil"></i></a>
        @endauth
      </h2>

      @foreach($parentDevices as $device)

        @if(count($device->subDevice))

          @foreach($device->subDevice as $sd)
            <div class="deviceType">
              <div class="deviceImageWrapper" style="background-image: url('{{ $sd->url('image') }}'">
                <div class="deviceImageOverlay"></div>
                <p class="deviceTypeTitle mb-0">{{ $sd->name }}</p>
              </div>
              <div class="deviceTextWrapper">
                @include('devices.subDeviceList', ['subDevices' => $sd->subDevice])
              </div>              
            </div>
          @endforeach

        @endif

      @endforeach
    </div>
  </div>
</section>