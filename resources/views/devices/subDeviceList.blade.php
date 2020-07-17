@foreach($subDevices as $subDevice)
 <ul class="deviceList">
    <li><p>{{$subDevice->name}}</p></li> 
  @if(count($subDevice->subDevice))
    @include('devices.subDeviceList',['subDevices' => $subDevice->subDevice])
  @endif
 </ul> 
@endforeach