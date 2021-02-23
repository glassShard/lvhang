@foreach($subPrices as $subPrice)
  <li class="row align-items-center mb-3 mb-xl-0">

    <input type="hidden" value="{{ $subPrice->id }}">
    <input type="hidden" value="{{ $subPrice->parent_id }}">
    
    @if($subPrice->price !== null)
      <div class="col-12 col-xl-3">
        <input type="text" class="form-control lv-form mb-1" name="name" placeholder="Megnevezés..." value="{{ $subPrice->name }}" title="Megnevezés">
      </div>

      <div class="col-6 col-sm-3 col-xl-1">
        <input type="number" class="form-control lv-form mb-1" name="name" placeholder="Áramszükséglet (W)..." value="{{ $subPrice->current }}" title="Áramszükséglet">
      </div>

      <div class="col-6 col-sm-3 col-xl-1">
        <input type="number" class="form-control lv-form mb-1" name="name" placeholder="Ember (db)..." value="{{ $subPrice->people }}" title="Ember">
      </div>

      <div class="col-6 col-sm-3 col-xl-1">
        <input type="number" class="form-control lv-form mb-1" name="name" placeholder="Darab (db)..." value="{{ $subPrice->piece }}" title="Darab">
      </div>

      <div class="col-6 col-sm-3 col-xl-1">
        <input type="number" class="form-control lv-form mb-1" name="name" placeholder="Ár (Ft)..." value="{{ $subPrice->price }}" title="Ár">
      </div>

      <div class="col-12 col-xl-3">
        <input type="text" class="form-control lv-form mb-1" name="name" placeholder="Leírás..." value="{{ $subPrice->description }}" title="Leírás">
      </div>
      
      <div class="col-12 col-xl-2 d-flex justify-content-end">
        
        <button type="button" class="btn btn-primary lv-btn btn-success btn-price d-inline-block save"><i class="fontello-floppy"></i></button>
          
        <button type="button" class="btn btn-primary lv-btn btn-danger btn-price delete"><i class="fontello-trash-1"></i></button>
        
        <button href="{{ route('devices.create-to-parent', ['parent' => $subPrice->id]) }}" type="button" class="btn btn-primary lv-btn btn-info btn-price copy"><i class="fontello-docs"></i></button>
      
      </div>

        
    @elseif($subPrice->parent_id === null)

      <div class="col-12 col-sm-10 col-xl-10">
        <input type="text" class="form-control lv-form main-category full-width mb-1" name="name" placeholder="Név..." value="{{ $subPrice->name }}">
      </div>

      <div class="col-12 col-sm-2 col-xl-2 d-flex justify-content-end">
        <button type="button" class="btn btn-primary lv-btn btn-success btn-price d-inline-block save"><i class="fontello-floppy"></i></button>

        <button type="button" class="btn btn-primary lv-btn btn-danger btn-price d-inline-block save"><i class="fontello-trash-1"></i></button>

        <button href="{{ route('devices.edit', ['device' => $subPrice->id]) }}" class="btn btn-primary lv-btn btn-info btn-price"><i class="fontello-doc-new"></i></button>
      </div>

    @elseif($subPrice->price === null)
   
      <div class="col-12 col-sm-10 col-xl-10">
        <input type="text" class="form-control lv-form sub-category mb-1" name="name" placeholder="Név..." value="{{ $subPrice->name }}">
      </div>
      
      <div class="col-12 col-sm-2 col-xl-2 d-flex justify-content-end">
        <button type="button" class="btn btn-primary lv-btn btn-success btn-price d-inline-block save"><i class="fontello-floppy"></i></button>

        <button type="button" class="btn btn-primary lv-btn btn-danger btn-price d-inline-block save"><i class="fontello-trash-1"></i></button>

        <button href="{{ route('devices.edit', ['device' => $subPrice->id]) }}" class="btn btn-primary lv-btn btn-info btn-price"><i class="fontello-doc-new"></i></button>
      </div>

    @endif

  </li>

  @if(count($subPrice->subPrice))
    @include('prices._form_subPriceList',['subPrices' => $subPrice->subPrice])
  @endif

@endforeach

