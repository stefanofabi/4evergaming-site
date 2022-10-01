@extends('base')

@section('description', 'Servidores de Juegos en Argentina: Rápido, Seguro y Soporte 365. Activación automática. ¡Encontrá el Servidor más barato con mejor servicio en 4evergaming!')

@section('robots', 'noindex, nofollow')

@section('title', 'Página no encontrada | 4evergaming')

@section('css')
<style>
  body {
    background-color: transparent;
    background-image: url("{{ asset('images/errors/404.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }

  .error-code {
    font-weight: 100;
    font-size: 120px;
    line-height: 1;
    color: #f47363;
    margin: -10px 0 30px 0;
    padding: 0;
  }

  .error-code-message {
    font-weight: 300;
    font-size: 50px;
    color: #fff;
    margin: 20px 0;
    text-shadow: 2px 3px 6px rgba(0,0,0,0.25);
  }

  .error-message {
    font-size: 24px;
    line-height: 1;
    color: #fff;
    text-shadow: 1px 2px 4px rgba(0,0,0,0.25);
  }
</style>
@endsection

@section('content')
<div class="text-center mt-5 error-page text-light">
  <h1 class="fw-bold error-code"> 
    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg> <br />
    Error 404 
  </h1>
    
  <h3 class="error-code-message">Oops... Pagina no encontrada!</h3>
  <p class="error-message">Lo sentimos, pero la página que estabas buscando no existe.</p>
    
  <a class="btn btn-danger btn-lg mt-3" href="{{ route('index') }}">   
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
      <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
    </svg> 
    Volver a la página principal
  </a>
</div>
@endsection