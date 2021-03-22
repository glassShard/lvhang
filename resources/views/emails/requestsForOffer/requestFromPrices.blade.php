<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  .green {
    color: green;
  }

  h1 {
    font-size: 24px;
  }
  h2 {
    font-size: 20px;
  }
  p {
    font-size: 16px;
  }
</style>

<p>A weblapról ajánlatot kértek az alábbi paraméterekkel:</p>
<hr>
<p>A küldő email címe: <a href="{{ $data['email'] }}">{{ $data['email'] }}</a></p>
<hr>
<p>A küldő üzenete:</p>
<p>{{ $data['message'] }}</p>
<hr>
<p>A küldő által választott szolgáltatások:</p>
@if ($data['priceRows'])
  <ul>
    @foreach($data['priceRows'] as $row)
      @if ($row['price'])
        <li>
          <p>{{ $row['name']}}
            @if ($row['unit'])
              @if ($row['value'])
                <span class="green"> {{ $row['value']}} </span>
              @else
                <span class="green">0 </span>
              @endif
              <span class="green"> {{ $row['unit']}}</td>
            @endif
          </p>          
        </li>
      @endif    
    @endforeach
  </ul>

  <p>A kiválasztott eszközök áramigénye összesen: {{ $data['sumCurrent'] }} A</p>
  <p>A kiválasztott eszközök becsült munkaerőigénye összesen: {{ $data['sumPeople'] }} fő</p>
  <p class="green">A kiválasztott eszközök kedvezmény nélküli ára: {{ $data['sumPrice'] }} Ft</p>
@else
  <p>A küldő nem választott ki szolgáltatást.</p>
@endif
<hr>
<p>Vége</p>



