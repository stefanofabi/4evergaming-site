Aquí tienes el código sin los comentarios:

```php
@extends('base')

@section('javascript')
    @parent
@endsection

@section('robots', 'index, follow')

@section('title', '4evergaming: ' . $community->name)

@section('description', 'Explora las comunidades más divertidas y emocionantes.')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .community-logo img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .community-details {
            text-align: center;
            margin-bottom: 40px;
        }

        .community-links a {
            margin: 0 10px;
            font-size: 24px;
            color: #007bff;
            text-decoration: none;
        }

        .community-links a:hover {
            text-decoration: underline;
        }

        .servers-list {
            margin-top: 40px;
        }

        .server {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .server-logo img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .server-details h3 {
            margin-top: 0;
        }

        .server-details p {
            margin: 5px 0;
        }

        .server-details a {
            display: inline-block;
            margin-top: 10px;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .server-details a:hover {
            background-color: #c82333;
        }

        .server-map-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .server-map img {
            width: 100%;
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .server-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .server-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .server-buttons .btn-join {
            background-color: #dc3545;
        }

        .server-buttons .btn-join:hover {
            background-color: #c82333;
        }

        .server-buttons .btn-stats {
            background-color: #007bff;
        }

        .server-buttons .btn-stats:hover {
            background-color: #0056b3;
        }
    </style>
@append

@section('content')
    <div class="container mt-5">
        <div class="community-details">
            <div class="community-logo mb-4">
                <img src="{{ asset('storage/communities/' . $community->logo) }}" alt="{{ $community->name }} Logo">
            </div>
            <h1>{{ $community->name }}</h1>
            <p class="lead">{{ $community->description ?? 'No hay descripción disponible para esta comunidad.' }}</p>

            <div class="community-links">
                @if($community->whatsapp)
                    <a href="{{ $community->whatsapp }}" target="_blank" class="text-dark text-decoration-none" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                @endif
                @if($community->instagram)
                    <a href="{{ $community->instagram }}" target="_blank" class="text-dark text-decoration-none" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                @if($community->tiktok)
                    <a href="{{ $community->tiktok }}" target="_blank" class="text-dark text-decoration-none" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                @endif
                @if($community->youtube)
                    <a href="{{ $community->youtube }}" target="_blank" class="text-dark text-decoration-none" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
                @if($community->discord)
                    <a href="{{ $community->discord }}" target="_blank" class="text-dark text-decoration-none" title="Discord">
                        <i class="bi bi-discord"></i>
                    </a>
                @endif
                @if($community->website)
                    <a href="{{ $community->website }}" target="_blank" class="text-dark text-decoration-none" title="Sitio Web">
                        <i class="bi bi-house-door"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="servers-list">
            <h2>Servidores de la Comunidad</h2>

            @foreach($servers as $server)
                <div class="server">
                    <div class="row w-100">

                        <div class="col-md-8">

                            <div class="server-details">
                                <h3>{{ $server->hostname }}</h3>
                                <p><strong>IP:</strong> {{ $server->ip }}:{{ $server->port }}</p>
                                <p><strong>Jugadores:</strong> {{ $server->num_players }} / {{ $server->max_players }}</p>
                                <p><strong>Mapa:</strong> {{ $server->map }}</p>
                                <p><strong>Estado:</strong> {{ $server->status ? 'ONLINE' : 'OFFLINE' }}</p>

                                <div class="server-buttons">
                                    <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" class="btn-stats">Ver estadísticas</a>
                                    <a href="{{ $server->join_link }}" class="btn-join">Unirse al servidor</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            @if(Storage::exists('public/maps/'. $server->game->protocol .'/'.$server->map .'.jpg'))
                            <div class="server-map-wrapper">
                                <img src="{{ asset('storage/maps/'. $server->game->protocol .'/'. $server->map .'.jpg') }}" alt="{{ $server->map }}" title="{{ $server->map }}" class="server-map img-fluid shadow" width="100%" />
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
```