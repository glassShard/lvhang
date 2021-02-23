@foreach($subPrices as $subPrice)
 <ul class="priceList">
    <li><p>{{$subPrice->name}}</p></li> 
  @if(count($subPrice->subPrice))
    @include('prices.subPriceList',['subPrices' => $subPrice->subPrice])
  @endif
 </ul> 
@endforeach