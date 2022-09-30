@extends('base')

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'index, follow')

@section('title', 'Servidores de Juegos en Argentina desde $217 al mes | 4evergaming')

@section('javascript')
<script>
  var cs_servers = [
      @foreach ($cs_servers as $server)
      ["{{ $server[0] }}", "{{ $server[1] }}"],
      @endforeach
  ];

  var csgo_servers = [
      @foreach ($csgo_servers as $server)
      ["{{ $server[0] }}", "{{ $server[1] }}"],
      @endforeach
  ];

  var mta_servers = [
      @foreach ($mta_servers as $server)
      ["{{ $server[0] }}", "{{ $server[1] }}"],
      @endforeach
  ];


  function removeTags(str) {
      if ((str===null) || (str===''))
          return false;
      else
          str = str.toString();
            
      // Regular expression to identify HTML tags in 
      // the input string. Replacing the identified 
      // HTML tag with a null string.
      return str.replace( /(<([^>]+)>)/ig, '');
  }

  function loadGame(game)
  {
    let index = 1;
    let servers = [];

    switch (game)
    {
      case 'cs16' : servers = cs_servers; break;
      case 'csgo' : servers = csgo_servers; break;
      case 'mta' : servers = mta_servers; break;
    }

    servers.forEach(
      server => {
        getGameState(game, server[0], server[1], index); index++;
      }
    )
  }
  
  function getGameState(game, ip, port, index)
  {

    var parameters = {
      "game": game,
      "ip": ip,
      "port": port,
    };

    $.ajax({
        data: parameters,
        url: "{{ route('api/games') }}",
        type: 'get',
        error: function (xhr, status) {

        },
        success: function (response) {
          let server = response[0];

          $("#"+game+"-name-"+index).html(removeTags(server.var.gq_hostname).substr(0, 45));

          let capacity = server.var.gq_numplayers * 100 / server.var.gq_maxplayers;
          if (capacity == 100) {
            $("#"+game+"-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-label="Danger striped example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity == 0) { 
            $("#"+game+"-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped" role="progressbar" aria-label="Warning striped example" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity > 75) {
            $("#"+game+"-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-label="Warning striped example" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity > 50) {
            $("#"+game+"-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-label="Info striped example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else {
            $("#"+game+"-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-label="Success striped example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>');
          }
          
          $("#"+game+"-map-"+index).html(removeTags(server.var.gq_mapname));
          $("#"+game+"-joinlink-"+index).html($("#"+game+"-joinlink-"+index).val()+'<a class="text-decoration-none text-dark text-end" href="'+removeTags(server.var.gq_joinlink)+'"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16"> <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/> <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/> </svg> </a>');
        }
    });
  }
</script>
@endsection

@section('content')
<div class="container mt-3">
  <div class="row">
    @include('pages/index/carousel')
    @include('pages/index/top_game_list') 
  </div>

  <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-info-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </svg>
    <div>
      Tenemos un conjunto de características y herramientas que convierten nuestros sistemas en los más versátiles del mercado al permitirle tomar el control de prácticamente de todo el servicio. Las potentes opciones y características de personalización le brindan flexibilidad para modificar su servicio como desea.
    </div>
  </div>

  <div class="row">
    @include('pages/index/cards/tcadmin_access')
    @include('pages/index/cards/clients_access')
    @include('pages/index/cards/payment_methods')
  </div>

  @include('pages/index/offcanvas/counter_strike16')
  @include('pages/index/offcanvas/counter_strike_global_offensive')
  @include('pages/index/offcanvas/multi_theft_auto')
  
</div>
@endsection