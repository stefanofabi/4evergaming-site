@extends('gametracker.base')

@section('javascript')
    @parent
@endsection

@section('robots', 'index, follow')

@section('title', '4evergaming: Listado de Comunidades')

@section('description', 'Explora las comunidades más divertidas y emocionantes.')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            width: 100%;
            height: 400px;
            object-fit: cover;
            margin: 0 auto;
            display: block;
        }

        .card-body {
            background-color: #f9f9f9;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .btn-info {
            transition: background-color 0.3s ease;
        }

        .btn-info:hover {
            background-color: #17a2b8;
        }

        .social-icons {
            font-size: 1.5rem;
        }

        .social-icons a {
            margin-right: 10px;
            color: #333;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #17a2b8;
        }
    </style>
@append

@section('content')
@php
    $myCommunity = auth()->check() ? auth()->user()->community()->first() : null;
@endphp

<div class="container mt-5 mb-5">
    <h1 class="text-light text-center mb-4">¡Explora Nuestras Comunidades!</h1>

    <!-- Buscador -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="/buscar-servidores" method="GET" class="input-group">
                <input type="text" name="query" class="form-control form-control-lg" placeholder="Buscar por nombre de la comunidad...">
                <button class="btn btn-danger btn-lg" type="submit">Buscar</button>
            </form>
        </div>
    </div>


    <!-- Botón destacado debajo del buscador -->
    @if (auth()->user() && auth()->user()->community)
    <div class="text-center mb-5">
        <a href="{{ route('communities/show', auth()->user()->community->id) }}"
           class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm transition">
            🏠 Mi Comunidad
        </a>
    </div>
    @else 
        <div class="text-center mb-5">
            <button class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm transition"
                data-bs-toggle="modal" data-bs-target="#addCommunityModal">
                ➕ Agregar Comunidad
            </button>
        </div>
    @endif


    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
        @foreach ($communities as $community)
            @if ($myCommunity && $myCommunity->id === $community->id)
                @continue
            @endif

            <div class="col">
                <div class="card h-100 text-light shadow border-0" style="background: linear-gradient(135deg, #222 30%, #111 100%);">
                    <div class="row g-0 h-100">
                        {{-- Logo --}}
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            <a href="{{ route('communities/show', $community->id) }}">
                                <img src="{{ asset('storage/communities/' . $community->logo) }}?t={{ strtotime($community->updated_at) }}" class="img-fluid rounded" alt="{{ $community->name }}">
                            </a>
                        </div>

                        {{-- Contenido y redes --}}
                        <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                            <div>
                                <h5 class="card-title">{{ $community->name }}</h5>
                                <p class="card-text text-light">{!! Str::limit(strip_tags($community->description), 120) !!}</p>
                            </div>
                            <div class="text-end mt-2">
                                @if ($community->whatsapp)
                                    <a href="https://wa.me/{{ $community->whatsapp }}" target="_blank" title="WhatsApp" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-whatsapp fs-5"></i>
                                    </a>
                                @endif
                                @if ($community->instagram)
                                    <a href="https://instagram.com/{{ $community->instagram }}" target="_blank" title="Instagram" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-instagram fs-5"></i>
                                    </a>
                                @endif
                                @if ($community->tiktok)
                                    <a href="https://www.tiktok.com/@{{ $community->tiktok }}" target="_blank" title="TikTok" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-tiktok fs-5"></i>
                                    </a>
                                @endif
                                @if ($community->youtube)
                                    <a href="https://youtube.com/{{ $community->youtube }}" target="_blank" title="YouTube" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-youtube fs-5"></i>
                                    </a>
                                @endif
                                @if ($community->discord)
                                    <a href="https://discord.gg/{{ $community->discord }}" target="_blank" title="Discord" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-discord fs-5"></i>
                                    </a>
                                @endif
                                @if ($community->website)
                                    <a href="{{ $community->website }}" target="_blank" title="Sitio Web" class="text-light ms-2 text-decoration-none">
                                        <i class="bi bi-globe2 fs-5"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('communities.create')
@endsection
