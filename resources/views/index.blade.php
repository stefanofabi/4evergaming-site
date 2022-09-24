@extends('base')

@section('title', 'Servidores de Juegos en Argentina desde $217 al mes | 4evergaming')

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col">

      <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{ asset('images/carousel/4everg2.png') }}" class="d-block w-100" alt="..." height="400">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="{{ asset('images/carousel/mundial-portada.png') }}" class="d-block w-100" alt="..." height="400">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/carousel/4everg3.png') }}" class="d-block w-100" alt="..." height="400">
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
          <span class="badge bg-success rounded-pill">+200</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">MTA San Andreas</div>
            ¿Me veo como un gángster? ¡Soy un hombre de negocios!
          </div>
          <span class="badge bg-success rounded-pill">+50</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">Counter-Strike: Global Offensive</div>
            Todos alguna vez lo hemos jugado. Pasan los años y sigue dando risas.
          </div>
          <span class="badge bg-success rounded-pill">+30</span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">MU Online</div>
            Esperame que ahora traigo a mi BK. 
          </div>
          <span class="badge bg-success rounded-pill">+5</span>
        </li>
      </ol>

    </div>
  </div>
</div>
@endsection
