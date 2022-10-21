@extends('base')

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'index, follow')

@section('title', '4evergaming: Servidores de Juegos en Argentina desde $217 al mes')

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

  var minecraft_servers = [
      @foreach ($minecraft_servers as $server)
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
      case 'minecraft' : servers = minecraft_servers; break;
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
          $("#"+game+"-name-"+index).html(xhr.statusText);
        },
        success: function (response) {
          let server = response[0];

          let hostname = removeTags(server.var.gq_hostname);

          if (hostname) 
          {
            $("#"+game+"-name-"+index).html(hostname.substr(0, 45));
          } 
          else 
          {
            $("#"+game+"-name-"+index).html("Servidor no encontrado: "+server.var.ip);
            return;
          }

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

  $(document).ready(function() {
    loadGame('cs16'); 
    loadGame('mta');
    loadGame('csgo');
    loadGame('minecraft');
  });
</script>
@endsection

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col">
      <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          @include('pages/home/carousel-slides/counter-strike16')
          @include('pages/home/carousel-slides/counter-strike-global-offensive')
          @include('pages/home/carousel-slides/multi-theft-auto')
          @include('pages/home/carousel-slides/minecraft')
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
      
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  
    <div class="col-4 d-none d-sm-none d-md-block ps-4">
      <h2> 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
        </svg> 

        <strong> Más populares </strong> 
      </h2>
      
      <ol class="list-group">
        @include('pages/home/popular-games/counter-strike16')
        @include('pages/home/popular-games/multi-theft-auto')
        @include('pages/home/popular-games/counter-strike-global-offensive')
        @include('pages/home/popular-games/minecraft')
      </ol>
    </div>
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
    @include('pages/home/cards/tcadmin_access')
    @include('pages/home/cards/clients_access')
    @include('pages/home/cards/payment_methods')
  </div>

  @include('pages/home/offcanvas/counter-strike16')
  @include('pages/home/offcanvas/counter-strike-global-offensive')
  @include('pages/home/offcanvas/multi-theft-auto')
  @include('pages/home/offcanvas/minecraft')
</div>
@endsection