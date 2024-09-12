@extends('base')

@section('description', 'Administracion interna de 4evergaming')

@section('robots', 'noindex, nofollow')

@section('title')
4evergaming: Panel de Administración
@endsection

@section('content')
    <div class="row mt-5 ms-3 me-3">
        <div class="col-md-2"> 
            <ul class="list-group">
                <li class="list-group-item"> <a href="{{ route('admin/index') }}"> Tablero </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/billing') }}"> Facturacion </a> </li>
                <li class="list-group-item"> <a href="{{ route('admin/nodes') }}"> Nodos </a> </li>
            </ul>      
        </div>

        <div class="col-md">
           @section('right-content') @show
        </div>
    </div>
@endsection