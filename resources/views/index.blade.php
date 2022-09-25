@extends('base')

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'index, follow')

@section('title', 'Servidores de Juegos en Argentina desde $217 al mes | 4evergaming')

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col">

      <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img loading="lazy" src="{{ asset('images/carousel/cs-wallpaper-01.jpg') }}" class="d-block w-100" alt="Jugador terrorista recargando el arma" height="400">

            <div class="carousel-caption d-none d-md-block">
              <h3>Protección Anticheat y Mitigación DDoS</h3>
              <p> Redes confiables y ultra rápidas sobre los carriers más importantes y reconocidos de la región </p>

              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" class="btn btn-danger" > 300 FPS </a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-1000fps?currency=2" class="btn btn-success"> 1000 FPS </a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-500fps?currency=2" class="btn btn-warning"> 500 FPS </a>
            </div>
          </div>

          <div class="carousel-item" data-bs-interval="2000">
            <img loading="lazy" src="{{ asset('images/carousel/csgo-wallpaper-01.jpeg') }}" class="d-block w-100" alt="Jugador Terrorista tomando la posicion a otro jugador Policia" height="400">
            
            <div class="carousel-caption d-none d-md-block">
              <h3> Sin contratos, cancelá en cualquier momento. </h3>
              <p> Sin Compromisos, ni contratos. Facturado cada mes. Sin costos ocultos. Servicio con garantía de reembolso </p>
            
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-global-offensive-64-tickrate?currency=2" class="btn btn-danger" > 64 Tick</a>
              <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-global-offensive-128-tickrate?currency=2" class="btn btn-success"> 128 Tick </a>
            </div>
          </div>

          <div class="carousel-item">
            <img loading="lazy" src="{{ asset('images/carousel/mta-wallpaper-01.jpg') }}" class="d-block w-100" alt="Gangster disparando por la ventana del auto" height="400">

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
            <div class="fw-bold">Counter-Strike 1.6</div>
            Para salir más rápido de tus problemas necesitas un cuchillo.
          </div>
          <span class="badge bg-danger rounded-pill">+200</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">MTA San Andreas</div>
            ¿Me veo como un gángster? ¡Soy un hombre de negocios!
          </div>
          <span class="badge bg-danger rounded-pill">+50</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">Counter-Strike: Global Offensive</div>
            Todos alguna vez lo hemos jugado. Pasan los años y sigue dando risas.
          </div>
          <span class="badge bg-danger rounded-pill">+30</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">MU Online</div>
            Esperame que ahora traigo a mi BK. 
          </div>
          <span class="badge bg-danger rounded-pill">+5</span>
        </li>
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


  <div class="container text-center">
    <div class="row">
      <div class="col">
        <div class="card" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/acceso-panel-tcadmin.jpg') }}" class="card-img-top" alt="Setup de computadora con RGB">
          <div class="card-body">
            <h5 class="card-title"> TCAdmin </h5>
            <p class="card-text">Administrá desde la web tu Servidor reduciendo cualquier acción a simples clicks. </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Instalación de plugins con un click</li>
            <li class="list-group-item">Estadísticas en tiempo real</li>
            <li class="list-group-item">Descargas rápidas</li>
            <li class="list-group-item">Gestión de subusuarios</li>
          </ul>
        
          <div class="card-body">
            <a href="http://tcadmin.4evergaming.com.ar" class="card-link">Ingresar</a>
            <a href="https://www.youtube.com/watch?v=--Ejk7Mq824" target="_blank" class="card-link">Realizar tour virtual</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/banner-acceso-clientes.jpg') }}" class="card-img-top" alt="Ingreso de credenciales web">
          <div class="card-body">
            <h5 class="card-title"> Acceso para clientes </h5>
            <p class="card-text"> 100% Online. Gestioná todos tus servicios de manera cómoda desde tu casa sin perder tu valioso tiempo. </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Activación automática</li>
            <li class="list-group-item">Resumen de facturación</li>
            <li class="list-group-item">Gestión de pagos</li>
            <li class="list-group-item">Programa de Afiliados</li>
          </ul>
        
          <div class="card-body">
            <a href="https://clientes.4evergaming.com.ar" class="card-link">Ingresar</a>
            <a href="https://clientes.4evergaming.com.ar/affiliates.php" target="_blank" class="card-link">Ver programa de Afiliados</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card" style="width: 18rem;">
          <img loading="lazy" src="{{ asset('images/banner-medios-de-pago.jpg') }}" class="card-img-top" alt="Medios de pago aceptados">
          <div class="card-body">
            <h5 class="card-title"> Medios de pago </h5>
            <p class="card-text"> Disfruta los mejores beneficios y participá de sorteos exclusivos! </p>
          </div>
          
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Billeteras virtuales <span class="badge text-bg-danger">10% descuento </span> </li>
            <li class="list-group-item">Transferencia CBU/CVU <span class="badge text-bg-danger">10% descuento </span> </li>
            <li class="list-group-item">Tarjetas de débito y crédito</li>
            <li class="list-group-item">Rapipago y PagoFacil</li>
            <li class="list-group-item">Criptomonedas</li>
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