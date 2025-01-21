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
            height: 200px; /* Tamaño fijo para el logo de la comunidad */
            object-fit: cover; /* Asegura que la imagen se ajuste sin distorsionarse */
            //border-radius: 10px;
            //box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .community-details {
            text-align: center;
            margin-bottom: 40px;
        }

        .community-links a {
            margin: 0 10px;
            font-size: 24px;
            color: #007bff;
            text-decoration: none; /* Removemos subrayado */
        }

        .community-links a:hover {
            text-decoration: underline; /* Aparece subrayado al pasar el ratón */
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
            height: 80px; /* Tamaño fijo para el logo del juego */
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
            background-color: #dc3545; /* btn-danger color */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .server-details a:hover {
            background-color: #c82333; /* btn-danger hover */
        }

        .server-map-wrapper {
            display: flex;
            justify-content: center; /* Centra la imagen horizontalmente */
            align-items: center; /* Centra la imagen verticalmente */
            width: 100%; /* Asegura que ocupe el espacio de la columna */
        }

        .server-map img {
            width: 100%; /* Hace que ocupe todo el ancho de su contenedor */
            max-width: 150px; /* Limita el ancho de la imagen del mapa */
            max-height: 150px; /* Limita la altura de la imagen del mapa */
            object-fit: cover; /* Asegura que la imagen se ajuste correctamente sin distorsionar */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .server-buttons {
            display: flex;
            gap: 10px; /* Espacio entre los botones */
            margin-top: 10px;
        }

        .server-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .server-buttons .btn-join {
            background-color: #dc3545; /* btn-danger */
        }

        .server-buttons .btn-join:hover {
            background-color: #c82333;
        }

        .server-buttons .btn-stats {
            background-color: #007bff; /* btn-primary */
        }

        .server-buttons .btn-stats:hover {
            background-color: #0056b3;
        }
    </style>
@append

@section('content')
    <div class="container mt-5">
        <!-- Datos de la comunidad -->
        <div class="community-details">
            <div class="community-logo mb-4">
                <img src="{{ asset('storage/communities/' . $community->logo) }}" alt="{{ $community->name }} Logo">
            </div>
            <h1>{{ $community->name }}</h1>
            <p class="lead">{{ $community->description ?? 'No hay descripción disponible para esta comunidad.' }}</p>

            <!-- Enlaces de la comunidad con Bootstrap Icons -->
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

        <!-- Lista de servidores -->
        <div class="servers-list">
            <h2>Servidores de la Comunidad</h2>

            @foreach($servers as $server)
                <div class="server">
                    <!-- Contenedor de columnas -->
                    <div class="row w-100">
                        <div class="col-md-8">
                            <!-- Información del servidor -->
                            <div class="server-details">
                                <h3>{{ $server->hostname }}</h3>
                                <p><strong>IP:</strong> {{ $server->ip }}:{{ $server->port }}</p>
                                <p><strong>Jugadores:</strong> {{ $server->num_players }} / {{ $server->max_players }}</p>
                                <p><strong>Mapa:</strong> {{ $server->map }}</p>
                                <p><strong>Estado:</strong> {{ $server->status ? 'ONLINE' : 'OFFLINE' }}</p>

                                <!-- Botones de unirse y ver estadísticas alineados horizontalmente -->
                                <div class="server-buttons">
                                    <a href="{{ $server->join_link }}" target="_blank" class="btn-join">Unirse al servidor</a>
                                    <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" class="btn-stats">Ver estadísticas</a>
                                </div>
                            </div>
                        </div>

                        <!-- Columna derecha con la imagen del mapa -->
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="server-map-wrapper">
                                <img src="{{ asset('storage/maps/'. $server->game->protocol .'/'. $server->map .'.jpg') }}" alt="{{ $server->map }}" title="{{ $server->map }}" class="server-map img-fluid shadow" width="100%" />
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
