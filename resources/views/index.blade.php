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

  function getGameState(game)
  {
    let index = 1;
    cs_servers.forEach(
      server => {
        loadGame(game, server[0], server[1], index); index++;
      }
    )
  }

  
  function loadGame(game, ip, port, index)
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

          $("#cs16-name-"+index).html(removeTags(server.var.gq_hostname));

          let capacity = server.var.gq_numplayers * 100 / server.var.gq_maxplayers;
          if (capacity == 100) {
            $("#cs16-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-label="Danger striped example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity == 0) { 
            $("#cs16-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped" role="progressbar" aria-label="Warning striped example" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity > 75) {
            $("#cs16-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-label="Warning striped example" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else if (capacity > 50) {
            $("#cs16-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-label="Info striped example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>');
          } else {
            $("#cs16-players-"+index).html('<div class="progress"> <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-label="Success striped example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>');
          }
          
          $("#cs16-map-"+index).html(removeTags(server.var.gq_mapname));
          $("#cs16-steam-"+index).html($("#cs16-steam-"+index).val()+'<a class="text-decoration-none text-dark text-end" href="'+removeTags(server.var.gq_joinlink)+'"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16"> <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/> <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/> </svg> </a>');
        }
    });
  }


</script>
@endsection

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col">

      <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img loading="lazy" src="{{ asset('images/carousel/cs-wallpaper-01.jpg') }}" class="d-block img-fluid" alt="Jugador terrorista recargando el arma" height="400">

            <div class="carousel-caption d-none d-md-block">
              <h3>Protección Anticheat y Mitigación DDoS</h3>
              <p> Redes confiables y ultra rápidas sobre los carriers más importantes y reconocidos de la región </p>

              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" class="btn btn-danger" > 300 FPS </a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-1000fps?currency=2" class="btn btn-success"> 1000 FPS </a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-500fps?currency=2" class="btn btn-warning"> 500 FPS </a>
            </div>
          </div>

          <div class="carousel-item" data-bs-interval="2000">
            <img loading="lazy" src="{{ asset('images/carousel/csgo-wallpaper-01.jpeg') }}" class="d-block img-fluid" alt="Jugador Terrorista tomando la posicion a otro jugador Policia" height="400">
            
            <div class="carousel-caption d-none d-md-block">
              <h3> Sin contratos, cancelá en cualquier momento. </h3>
              <p> Sin Compromisos, ni contratos. Facturado cada mes. Sin costos ocultos. Servicio con garantía de reembolso </p>
            
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-global-offensive-64-tickrate?currency=2" class="btn btn-danger" > 64 Tick</a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-global-offensive-128-tickrate?currency=2" class="btn btn-success"> 128 Tick </a>
            </div>
          </div>

          <div class="carousel-item">
            <img loading="lazy" src="{{ asset('images/carousel/mta-wallpaper-01.jpg') }}" class="d-block img-fluid" alt="Gangster disparando por la ventana del auto" height="400">

            <div class="carousel-caption d-none d-md-block">
              <h3> Recursos sin límites </h3>
              <p> Tu Comunidad crece y necesitas más... perfecto!!! te ayudamos a reconfigurar tu servidor o migrar a otro hardware </p>
            
              <a href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/san-andreas-multi-player-samp?currency=2" class="btn btn-success" > GTA San Andreas</a>
              <a href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/multi-theft-auto-mta?currency=2" class="btn btn-success"> MTA San Andreas </a>
            </div>
          </div>
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

        <strong> Top Game List </strong> 
      </h2>
      
      <ol class="list-group list-group-numbered">
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrike16" aria-controls="offcanvasCounterStrike16" onclick="getGameState('cs16')">
                Counter-Strike 1.6 
              </a> 
            </div>
            Para salir más rápido de tus problemas necesitas un cuchillo.
          </div>
          <span class="badge bg-danger rounded-pill">+200</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              MTA San Andreas
            </div>
            ¿Me veo como un gángster? ¡Soy un hombre de negocios!
          </div>
          <span class="badge bg-danger rounded-pill">+50</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
              <a type="button" class="text-decoration-none text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCounterStrikeGlobalOffensive" aria-controls="offcanvasCounterStrikeGlobalOffensive">
                Counter-Strike: Global Offensive
              </a> 
            </div>
            Todos alguna vez lo hemos jugado. Pasan los años y sigue dando risas.
          </div>
          <span class="badge bg-danger rounded-pill">+30</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
                MU Online
            </div>
            Esperame que ahora traigo a mi BK. 
          </div>
          <span class="badge bg-danger rounded-pill">+5</span>
        </li>
      </ol>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCounterStrike16" aria-labelledby="offcanvasCounterStrike16Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title"> Counter-Strike 1.6</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body">
          <p> Gracias por seguir confiando en 4evergaming. Te presentamos el Top 5 para que disfrutes al máximo: </p>
          <table class="table">
            <thead>
              <tr>
                <th class="text-left" scope="col"> Comunidad </th>
                <th class="text-center" scope="col"> Jugadores</th>
                <th class="text-center" scope="col"> Mapa</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ([1,2,3,4,5] as $value)
              <tr>
                <td style="font-size: 12px" id="cs16-name-{{ $value }}"></td>
                <td style="font-size: 12px" id="cs16-players-{{ $value }}"></td>
                <td style="font-size: 12px" id="cs16-map-{{ $value }}"></td>
                <td style="font-size: 12px" id="cs16-steam-{{ $value }}"></td>
              @endforeach
              </tr>
            </tbody>
          </table>

          <p class="text-center" id="endMessage"> Estas buscando mas servidores? Visitá <a href="https://cincoya.net"> cincoya.net </a> </p>
        </div>

      </div>
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

  <div class="container text-center">
    <div class="row">
      <div class="col">
        <div class="card mt-3" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/acceso-panel-tcadmin.jpg') }}" class="card-img-top" alt="Setup de computadora con RGB">
          <div class="card-body">
            <h5 class="card-title"> TCAdmin </h5>
            <p class="card-text">Administrá desde la web tu Servidor reduciendo cualquier acción a simples clicks. </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor" viewBox="0 0 16 16">
                <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
              </svg>
              Instalación de plugins con un click
            </li>

            <li class="list-group-item"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
              </svg>
              Estadísticas en tiempo real
            </li>

            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708l2 2z"/>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
              </svg>
              Descargas rápidas
            </li>

            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
              </svg>
              Gestión de subusuarios
            </li>
          </ul>
        
          <div class="card-body">
            <a href="http://tcadmin.4evergaming.com.ar" class="card-link">Ingresar</a>
            <a href="https://www.youtube.com/watch?v=--Ejk7Mq824" target="_blank" class="card-link">Realizar tour virtual</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card mt-3" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/banner-acceso-clientes.jpg') }}" class="card-img-top" alt="Ingreso de credenciales web">
          <div class="card-body">
            <h5 class="card-title"> Acceso para clientes </h5>
            <p class="card-text"> 100% Online. Gestioná todos tus servicios de manera cómoda desde tu casa sin perder tu valioso tiempo. </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightning-charge" viewBox="0 0 16 16">
                <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z"/>
              </svg>
              Activación automática
            </li>

            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
              </svg>
              Resumen de facturación
            </li>

            <li class="list-group-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
              </svg>
              Gestión de pagos
            </li>

            <li class="list-group-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
              <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
            </svg>
              Programa de Afiliados
            </li>
          </ul>
        
          <div class="card-body">
            <a href="https://clientes.4evergaming.com.ar?currency=2" class="card-link">Ingresar</a>
            <a href="https://clientes.4evergaming.com.ar/affiliates.php?currency=2" target="_blank" class="card-link">Ver programa de Afiliados</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card mt-3" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/banner-medios-de-pago.jpg') }}" class="card-img-top" alt="Medios de pago aceptados">
          <div class="card-body">
            <h5 class="card-title"> Medios de pago </h5>
            <p class="card-text"> Disfruta los mejores beneficios y participá de sorteos exclusivos! </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
              </svg> 
              Billeteras virtuales <span class="badge text-bg-danger"> 10% descuento </span> 
            </li>

            <li class="list-group-item"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
              </svg> 
              <a class="text-decoration-none text-dark" href="{{ asset('transferencia-cbu-brubank.pdf') }}" target="_blank"> 
                Transferencia CBU 
              </a> 
                <span class="badge text-bg-danger"> 10% descuento </span> 
            </li>
            
            <li class="list-group-item"> 
              <a class="text-decoration-none text-dark" href="https://link.mercadopago.com.ar/4evergaming" target="_blank"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                  <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                </svg> Tarjeta de débito o crédito
              </a> 
            </li>

            <li class="list-group-item"> 
              <a class="text-decoration-none text-dark" href="https://link.mercadopago.com.ar/4evergaming" target="_blank"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                  <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                  <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                </svg> 
                Rapipago o PagoFacil 
              </a>
            </li>

            <li class="list-group-item"> 
              <a class="text-decoration-none text-dark" href="{{ asset('qr-code-4evergaming.pdf') }}" target="_blank"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                  <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                  <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"/>
                  <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"/>
                  <path d="M12 9h2V8h-2v1Z"/>
                </svg>
                Escanear QR 
              </a> 
            </li>

            <li class="list-group-item"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-bitcoin" viewBox="0 0 16 16">
                <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25L5.5 13zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28V4.487zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927V8.539z"/>
              </svg> 
              <a class="text-decoration-none text-dark" href="https://www.blockchain.com/btc/address/1BxrkKPuLTkYUAeMrxzLEKvr5MGFu3NLpU" target="_blank"> 
                Pagar con bitcoin 
              </a> 
            </li>
          </ul>
        
          <div class="card-body">
            <a href="https://clientes.4evergaming.com.ar/knowledgebase/20/Medios-de-pago.html" target="_blank" class="card-link">Ver todos los medios de pago</a>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection