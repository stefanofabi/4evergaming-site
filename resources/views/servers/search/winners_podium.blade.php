@section('css')
<style>

.podium__item {
  width: 200px;
}

.podium__number {
  width: 27px;
  height: 75px;
}

.podium .first {
  min-height: 300px;
  background: rgb(255,172,37);
background: 
  linear-gradient(333deg, 
  rgba(255,172,37,1) 0%, 
  rgba(254,207,51,1) 13%, 
  rgba(254,224,51,1) 53%, 
  rgba(255,172,37,1) 100%);
}

.podium .second {
  min-height: 200px;
  background: blue;
}

.podium .third {
  min-height: 100px;
  background: green;
}

.winner-image {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #fff;
      margin-bottom: 10px;
    }

  </style>
@append

<div class="row justify-content-center">
    <div class="col-9 fs-1 text-center"> Podio de los Ganadores 🏆 </div>

    <div class="col-9 text-center fs-5"> 
        ¡Enhorabuena al trío ganador! 🏆 Cada uno de ustedes ha brillado con un talento excepcional. <br /> 
        Su dedicación y habilidad han elevado este evento a nuevas alturas. ¡Felicidades por sus merecidos logros! 🌟🎉 
    </div>
</div>

<div class="d-flex justify-content-center align-items-end podium mt-4">
    <div class="podium__item">
        <div class="text-center"> 
            <img class="winner-image" src="{{ asset('storage/communities/'.$top_servers->skip(1)->take(1)->first()->community->logo) }}" alt="Ganador 2">
            <div class="text-center fs-2"> {{ $top_servers->skip(1)->take(1)->first()->community->name }} </div>
        </div>

      <div class="d-flex justify-content-center align-items-center fs-2 text-white second"> 2 </div>
    </div>

    <div class="podium__item">
        <div class="text-center"> 
            <img class="winner-image" src="{{ asset('storage/communities/'.$top_servers->first()->community->logo) }}" alt="Ganador 1">
            <div class="text-center fs-2"> {{ $top_servers->first()->community->name }} </div>
        </div>

      <div class="d-flex justify-content-center align-items-center fs-1 text-white first">
        <svg class="podium__number" viewBox="0 0 27.476 75.03" xmlns="http://www.w3.org/2000/svg">
            <g transform="matrix(1, 0, 0, 1, 214.957736, -43.117417)">
            <path class="st8" d="M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z" style="fill: #000;"/>
            </g>
        </svg>
      </div>
    </div>
  
    <div class="podium__item">
        <div class="text-center"> 
            <img class="winner-image" src="{{ asset('storage/communities/'.$top_servers->skip(2)->take(1)->first()->community->logo) }}" alt="Ganador 3">
            <div class="text-center fs-2"> {{ $top_servers->skip(2)->take(1)->first()->community->name }} </div>
        </div>

      <div class="d-flex justify-content-center align-items-center fs-3 text-white third"> 3 </div>
    </div>
</div>