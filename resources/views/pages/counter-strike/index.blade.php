@extends('base')

@section('description', 'Hosting Counter-Strike 1.6 en Argentina hasta 1000FPS! Con protección Anticheat y Mitigación DDoS. Activación automática. Servicio personalizable con clicks. Soporte por WhatsApp los 365 días del año.')

@section('robots', 'index, follow')

@section('title', '4evergaming: Hosting de Counter-Strike 1.6 en Argentina desde $224 al mes')

@section('css')
<style>
.game_header_image_full {
	width: 100%;
	height: 151px;
}

.game_description_snippet {
    margin-top: 10px;
	max-height: 111px;
	overflow: hidden;
    //font-size: 13px;
    line-height: 18px;
    padding-right: 16px;
}

.carousel-slides {
    width: 100%;
	height: 400px;
}

.latency-image {
    background-color: transparent;
    background-image: url("{{ asset('images/games/counter-strike/counter-strike-latency.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: 75% 25%;
    opacity: 0.95;
}
</style>
@endsection

@section('content')
<div class="container mt-3">
    <div class="d-none d-md-block"> Todos los juegos > Shooters > Counter-Strike </div>

    <h1 class="d-none d-md-block mt-2"> Counter-Strike 1.6 </h1>

    <div class="row">
        <div class="col-md-8 d-none d-md-block">   
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img loading="lazy" class="carousel-slides" src="{{ asset('images/games/counter-strike/counter-strike-1.jpg') }}" class="d-block w-100" alt="...">
                    </div>

                    @for ($i=2; $i <= 10; $i++)
                    <div class="carousel-item">
                        <img loading="lazy" class="carousel-slides" src="{{ asset('images/games/counter-strike/counter-strike-'.$i.'.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    @endfor
                </div>
            
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col">
            <img loading="lazy" class="game_header_image_full" src="{{ asset('images/games/counter-strike/official-banner-counter-strike16.jpg') }}" alt="Logo oficial de Counter-Strike 1.6" title="El Logo Oficial de Counter-Strike 1.6">
            <h1 class="d-block d-sm-none mt-2"> Counter-Strike 1.6 </h1>

            <p class="game_description_snippet"> Disfruta del juego de acción en línea n° 1 en el mundo. Sumérgete en el fragor de la guerra antiterrorista más realista con este archiconocido juego por equipos. Alíate con compañeros para superar misiones estratégicas, asalta bases enemigas, rescata rehenes, y recuerda que tu personaje contribuye al éxito del equipo...</p>							
            
            <p>
                Calificacion: 
                @for ($i=1; $i <= 5; $i++)
                <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
                @endfor   
            </p>
            
            <div class="mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                    <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
                    <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
                </svg> Etiquetas populares: <br />
                    
                <span class="badge text-bg-danger">Acción</span>
                <span class="badge text-bg-danger">FPS</span>   
                <span class="badge text-bg-danger">Multijugador</span>
                <span class="badge text-bg-danger">Disparos</span>  
                <span class="badge text-bg-danger">Basado en equipos</span> 
                <span class="badge text-bg-danger">Vieja escuela</span> 
                <span class="badge text-bg-danger">Competitivo</span> 
                <span class="badge text-bg-danger">Clasico</span> 
                <span class="badge text-bg-danger">Primera persona</span> 
            </div>
        </div>
    </div>

    <div class="text-center mt-5 ps-3 pe-3 pt-4 pb-4 text-white latency-image">
        <h2 class="fs-1 fw-bold"> La mejor latencia del mercado nacional </h2>
                    
        <h6 style="text-shadow: 1px 1px 2px black;"> 
            Con más de 30 puntos en todo el país donde se produce el intercambio de tráfico entre las redes de diversas entidades. 
        </h6>

        <div class="mt-3"> 
            <button class="btn btn-danger"> Ver puntos de interconexión </button> 
        </div>
    </div>

    <div class="row mt-5">
        <div class="col d-none d-md-block">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/--Ejk7Mq824?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        
        <div class="col">
            <div class="mt-2">
                <h4> Administrador de plugins y mods </h4>
                <hr class="border border-danger border-1 opacity-50 w-75">
                <p> Brindamos un servicio completamente personalizable, brindando al cliente la posibilidad de agregar distintas personalizaciones a su servidor con realizar un simple click. </p>
            </div>
            
            <div class="mt-3">
                <h4> Agregar mapas </h4>
                <hr class="border border-danger border-1 opacity-50 w-50">
                <p> Te damos la posibilidad de agregar todos los mapas que necesites para que puedas disfrutar el servidor al máximo. </p>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col mt-2">          
            <div class="mt-2 pe-3">
                <h4> Descargas rápidas </h4>
                <hr class="border border-danger border-1 opacity-50 w-50">
                <p> De nada serviria personalizar tu servidor si tus jugadores se cansan en la espera, es por eso que te brindamos un servicio de descargas rápidas totalmente sincronizado. </p>
            </div>

            <div class="mt-3 pe-3">
                <h4> Panel de control web <span class="badge text-bg-danger"> Premium </span></h4>
                <hr class="border border-danger border-1 opacity-50 w-75">
                <p> Con <a href="https://cstrike-webadmin.4evergaming.net" target="_blank">cstrike-webadmin</a> ponemos a tu disposición un sitio web sencillo y fácil de usar para gestionar el estado de los servidores, los rangos de acceso, añadir nuevos administradores, chat en línea, etc. </p>
            </div>
        </div>

        <div class="col d-none d-md-block">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/GHmbKpRhXGE?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    
    <div class="mt-5"> 
        <p class="fs-3 text-center"> Características de los servidores: </p>
        
        <div class="container bg-secondary bg-opacity-10 lh-lg ps-4 pe-4 pt-4 pb-4">
            <div class="row">
                <div class="col-md">
                    <span> <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Admins y plugins ilimitados </span>
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Panel de control web
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Protección Anticheat
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Sistema de mitigación de ataques
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Acceso FTP
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    ReHLDS disponible
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Fast download
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    Acceso RCON
                </div>
                <div class="col-md">
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                    0 loss, 0 choke
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">
    <div class="col">
        <div class="mt-2 pe-3">
            <h4> Que son los FPS de un Servidor?</h4>
            <hr class="border border-danger border-1 opacity-50 w-75">
            <p> La tasa de frames, o frames por segundo (FPS), mide el número de veces que el hardware del Servidor recalcula el estado del juego. </p>
            <p> Este es un factor decisivo, especialmente en videojuegos como los shooters en primera persona, ya que mejora la puntería. En la práctica, un mayor framerate permite realizar disparos más precisos. </p>
            <p> 
                Repasando! Lo recomendado siempre es disponer la mayor cantidad de FPS en nuestro servidor. 
                Esto va realizar mayor cantidad de calculos y se va traducir en:
                <div>
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg> Disparos más precisos
                </div>
                
                <div>
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg> Imágen más fluida
                </div>

                <div>
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg> Posición de los jugadores sin retrasos
                </div>

                <div>
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg> Menor latencia
                </div>

                <div>
                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg> Menor perdida de paquetes
                </div>
            </p>
        </div>
    </div>

    <div class="col-md">
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false"> <h5 class="fw-bold text-danger"> 300FPS </h5> </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"> <h5 class="fw-bold text-warning"> 500FPS </h5> </button>
        </li>   
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true"> <h5 class="fw-bold text-success"> 1000FPS </h5> </button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <h3 class="fw-bold mt-3"> Ideal para uso personal </h3>
            <p> 
                Disfrutá de todas nuestras características al precio más bajo del mercado sin reducir calidad.
                Perfecto para jugar con amigos y divertirse un rato. 
            </p>

            <div class="row position-center ps-5 pe-5 mt-2">
                <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" target="_blank" class="btn btn-danger"> Ver lista completa de precios </a>
            </div>

            <table class="table mt-4">
                <thead>
                    <tr>
                    <th scope="col">Jugadores</th>
                    <th scope="col">Precio</th>
                    <th> </th>
                    </tr>
                </thead>
                
                <tbody>
                    @for ($i=4; $i <= 32; $i=$i+4)
                    <tr>
                        <td> 
                            {{ $i }} jugadores 
                            @if ($i == 4) <span class="badge text-bg-info"> Ideal para pruebas </span> @endif
                            @if ($i == 12) <span class="badge text-bg-success"> Ideal para empezar </span> @endif
                            @if ($i == 16) <span class="badge text-bg-danger">Más vendido</span> @endif 
                            @if ($i == 24) <span class="badge text-bg-success">Ideal para servidor público</span> @endif 
                        </td>
                        <td> ${{ $i * $slot_300fps_price * $dollar_price}}/mes </td>
                        <td class="text-end"> 
                            <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" target="_blank" class="text-dark"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </a> 
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table> 
        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h3 class="fw-bold mt-3"> Ideal para comunidades medianas </h3>
            <p> 
                ¡Simple, rápido y confiable! Servicio todo en uno. No tenés que preocuparte por nada. Servidores rateados para obtener la mayor performance.
            </p>

            <div class="row position-center ps-5 pe-5 mt-2">
                <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-500fps?currency=2" target="_blank" class="btn btn-danger"> Ver lista completa de precios </a>
            </div>

            <table class="table mt-4">
                <thead>
                    <tr>
                    <th scope="col">Jugadores</th>
                    <th scope="col">Precio</th>
                    <th> </th>
                    </tr>
                </thead>
                
                <tbody>
                    @for ($i=4; $i <= 32; $i=$i+4)
                    <tr>
                        <td> 
                            {{ $i }} jugadores
                            @if ($i == 4) <span class="badge text-bg-success"> Ideal para Mod 2vs2 </span> @endif
                            @if ($i == 12) <span class="badge text-bg-success"> Ideal para Mod 5vs5 </span> @endif
                            @if ($i == 16) <span class="badge text-bg-danger">Más vendido</span> @endif
                            @if ($i == 24) <span class="badge text-bg-success">Ideal para Mod público</span> @endif 
                        </td>
                        <td> ${{ $i * $slot_500fps_price * $dollar_price}}/mes </td>
                        <td class="text-end"> 
                            <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-500fps?currency=2" target="_blank" class="text-dark"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </a> 
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table> 
        </div>

        <div class="tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

            <h3 class="fw-bold mt-3"> Ideal para comunidades exigentes</h3>
            <p> 
                Este plan está diseñado para esas personas que no dejan nada al azar, ni un solo disparo. 
                Combinamos todos nuestros planes para crear un servidor único con alta performance.
                Muy útil a la hora de jugar cerrados 5v5 o mods de competición. 
            </p>

            <div class="row position-center ps-5 pe-5 mt-2">
                <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-1000fps?currency=2" target="_blank" class="btn btn-danger"> Ver lista completa de precios </a>
            </div>

            <table class="table mt-4">
                <thead>
                    <tr>
                    <th scope="col">Jugadores</th>
                    <th scope="col">Precio</th>
                    <th> </th>
                    </tr>
                </thead>
                
                <tbody>
                    @for ($i=4; $i <= 32; $i=$i+4)
                    <tr>
                        <td> 
                            {{ $i }} jugadores 
                            @if ($i == 8) <span class="badge text-bg-success"> Ideal para practicar </span> @endif
                            @if ($i == 12) <span class="badge text-bg-danger"> Más vendido </span> @endif
                            @if ($i == 20) <span class="badge text-bg-success"> Ideal para Mod Deathmatch </span> @endif  
                            @if ($i == 24) <span class="badge text-bg-success"> Ideal para Mods exigentes </span> @endif 
                        </td>
                        <td>  ${{ $i * $slot_1000fps_price * $dollar_price}}/mes </td>
                        <td class="text-end"> 
                            <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-1000fps?currency=2" target="_blank" class="text-dark"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </a> 
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table> 
        </div>
    </div>
    </div>
    </div>
</div>
@endsection