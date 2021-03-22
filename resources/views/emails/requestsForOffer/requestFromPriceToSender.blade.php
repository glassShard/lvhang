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
  .wrapper {
    padding: 50px;
    max-width: 800px;
  }
</style>
<div class='wrapper'>
  <p>Kedves {{ $data['email'] }}!</p>
  <br>
  <p>Ön ajánlatot kért az lvhang.hu weblapról az alábbi paraméterekkel:</p>
  <hr>
  <p>Üzenete:</p>
  <p>{{ $data['message'] }}</p>
  <hr>
  <p>Kiválasztott szolgáltatások:</p>
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
    <p>Ön nem választott ki szolgáltatást.</p>
  @endif
  <hr>
  <p>Köszönjük levelét, ajánlatunkat rövidesen eljuttatjuk az Ön részére.</p>
  <br>
  <p>Üdvözlettel:</p>
  <p>L.V.Hang</p>
  <p><a href="https://lvhang.hu">lvhang.hu</a></p>
  <p><a href="mailto:lvhang@mentha.hu">lvhang@mentha.hu</a></p>
</div>




