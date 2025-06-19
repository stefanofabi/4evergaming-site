@extends('base')

@section('description', 'Administración interna de 4evergaming')

@section('robots', 'noindex, nofollow')

@section('title')
4evergaming: Panel de Administración
@endsection

@section('content')
    <div class="row mt-3 ms-3 me-3">
        <div class="col-md-2 mt-2"> 
            <ul class="list-group">
                <li class="list-group-item"> <a href="{{ route('admin/index') }}"> Tablero </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/payments') }}"> Pagos </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/billing') }}"> Facturacion </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/subscriptions/index') }}"> Suscripciones </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/nodes') }}"> Nodos </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/sensors') }}"> Sensores </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/firewall/index') }}"> Firewall </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/game_history') }}"> Historial de juegos </a> </li>
            </ul>      
        </div>

        <div class="col-md mt-2">
           @section('right-content') @show
        </div>
    </div>
@endsection