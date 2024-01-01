@section('css')
<style>
.getBig:hover {
      transform: scale(1.10);
      opacity: 0.95;
      box-shadow: 0px 3px 10px -2px black;
}
</style>
@endsection

<div class="mt-3 ms-3">
  <h2 class="text-center fw-bold"> Game Tracker <span class="badge text-bg-success fs-5"> ONLINE </span> </h2>

  <h4 class="mt-3 text-center"> Buscá nuevos servidores ⚔️ </h4>

  <p class="text-center"> 
    ¿Competitivo 5v5? ¿Práctica? ¿DM? ¿Retakes? <br />
    ¿Duelos 1v1 & 2v2? ¿KZ? ¿Surf? <br />
  </p>
  
  <div class="text-center">
    <a type="button" class="btn btn-outline-danger m-1 getBig" href="{{ route('servers/search', ['game' => 'cs16']) }}"> <img loading="lazy" src="{{ asset('images/games-icons/counter-strike16.ico') }}" alt="Logo de Counter-Strike 1.6" width="30" height="30" title="The Counter Strike Logo"> CS 1.6 </a>

    <a type="button" class="btn btn-outline-danger m-1 getBig" href="{{ route('servers/search', ['game' => 'cs2']) }}"> <img loading="lazy" src="{{ asset('images/games-icons/counter-strike-2.bmp') }}" alt="Logo de Counter-Strike 2" width="30" height="30" title="The Counter Strike 2 Logo">  CS2 </a>

    <a type="button" class="btn btn-outline-danger m-1 getBig" href="{{ route('servers/search', ['game' => 'mta']) }}"> <img loading="lazy" src="{{ asset('images/games-icons/multi-theft-auto.ico') }}" alt="Logo de Multi Theft Auto" width="30" height="30" title="The Multi Theft Auto Logo">  MTA </a>

    <a type="button" class="btn btn-outline-danger m-1 getBig" href="{{ route('servers/search', ['game' => 'minecraft']) }}"> <img loading="lazy" src="{{ asset('images/games-icons/minecraft.ico') }}" alt="Logo de Minecraft" width="30" height="30" title="The Minecraft Logo">  Minecraft </a>

    <a type="button" class="btn btn-outline-danger m-1 getBig"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
      </svg>

      Ver todos 
    </a>
  </div>
</div>

<div class="mt-5 ms-3 text-center">
  <p class="fst-italic fs-6"> * 4evergaming no se hace responsable de la conducta de los jugadores y espera que estos actúen en conformidad con las normas establecidas </p>
</div>
