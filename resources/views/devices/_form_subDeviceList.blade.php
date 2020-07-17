@foreach($subDevices as $subDevice)
 <ul class="formDeviceList">
    <li class=d-flex>

      @if($subDevice->parent_id === 2 | $subDevice->parent_id === 1)
        <form class="lv-form-inline">
          <input type="text" class="form-control lv-form lv-inline mb-1" name="name" placeholder="Eszköz vagy kategória neve..." value="{{ $subDevice->name }}" disabled>
        </form>  
        
        <a href="{{ route('devices.edit', ['device' => $subDevice->id]) }}" class="btn btn-lg btn-primary lv-btn btn-info mb-1 ml-4 mr-1"><i class="fontello-pencil"></i></a>
      @else

        <form action="{{ route('devices.update', ['device' => $subDevice->id]) }}" class="lv-form-inline" method="POST">
      
          @csrf 
          @method('PUT')

          <input type="text" class="form-control lv-form lv-inline mb-1" name="name" placeholder="Eszköz vagy kategória neve..." value="{{ $subDevice->name }}">
        
          <button type="submit" class="btn btn-lg btn-primary lv-btn btn-success mb-1 ml-4 mr-1 d-inline-block"><i class="fontello-floppy"></i></button>

        </form>

      @endif
      <form action="{{ route('devices.destroy', ['device' => $subDevice->id]) }}" class="" method="POST">
  
        @csrf 
        @method('DELETE')

        <button type="submit" class="btn btn-lg btn-primary lv-btn btn-danger mb-1 mr-1"><i class="fontello-trash-1"></i></button>
      
      </form>
      <a href="{{ route('devices.create-to-parent', ['parent' => $subDevice->id]) }}" type="submit" class="btn btn-lg btn-primary lv-btn btn-info mb-1"><i class="fontello-doc-new"></i></a>
    </li>

    @if(count($subDevice->subDevice))
      @include('devices._form_subDeviceList',['subDevices' => $subDevice->subDevice])
    @endif
     
 </ul> 
@endforeach

