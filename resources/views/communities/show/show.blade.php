@extends('gametracker.base')

@section('javascript')
<script type="module">
  $("#communityDataForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('communities/update', ['id' => $community->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveCommunityDataButton').addClass("disabled");
                $('#communityDataForm').css("opacity",".5");
                $('#responseCommunityData').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseCommunityData').html('<span style="font-size:18px;color:#34A853"> Comunidad '+ response.name +' actualizada exitosamente </span>');
            $('#communityDataForm').css("opacity","");
            $("#saveCommunityDataButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseCommunityData').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#communityDataForm').css("opacity","");
            $("#saveCommunityDataButton").removeClass("disabled");
          });
  });

  $("#communityLogoForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('communities/update', ['id' => $community->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveCommunityLogoButton').addClass("disabled");
                $('#communityLogoForm').css("opacity",".5");
                $('#responseCommunityLogo').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseCommunityLogo').html('<span style="font-size:18px;color:#34A853"> Logo de la Comunidad '+ response.name +' actualizado exitosamente </span>');
            $('#communityLogoForm').css("opacity","");
            $("#saveCommunityLogoButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseCommunityLogo').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#communityLogoForm').css("opacity","");
            $("#saveCommunityLogoButton").removeClass("disabled");
          });
  });

  $("#communitySocialLinkForm").on('submit', function(e){
    e.preventDefault();
    
    $.ajax({
            type: 'POST',
            url: "{{ route('communities/update', ['id' => $community->id]) }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#saveCommunitySocialLinkButton').addClass("disabled");
                $('#communitySocialLinkForm').css("opacity",".5");
                $('#responseCommunitySocialLink').html('<span style="font-size:18px;color:#34A853"> Cargando espere...</span>');
            }
          }).done(function(response) {
            $('#responseCommunitySocialLink').html('<span style="font-size:18px;color:#34A853"> Redes sociales de la Comunidad '+ response.name +' actualizado exitosamente </span>');
            $('#communitySocialLinkForm').css("opacity","");
            $("#saveCommunitySocialLinkButton").removeClass("disabled");
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#responseCommunitySocialLink').html('<span style="font-size:18px;color: red"> '+ jqXHR.responseJSON.message +' </span>');
            $('#communitySocialLinkForm').css("opacity","");
            $("#saveCommunitySocialLinkButton").removeClass("disabled");
          });
  });
</script>


<script>
  function saveCommunity() 
  {
    $('#communityFormSubmitButton').click();
  }
</script>
@append

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
            height: 100%;
        }

        .server-logo img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .server-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            flex: 1;
        }

        .server-details h3 {
            margin-top: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .server-details p {
            margin: 5px 0;
        }

        .server-details a {
            display: inline-block;
            margin-top: 10px;
            //background-color: #dc3545;
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
            flex: 0 1 auto;
            height: 100%;
        }

        .server-map img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@append

@section('content')
    <div class="container mt-5">
        <div class="community-details">
            <div class="community-logo mb-4">
                <img src="{{ asset('storage/communities/' . $community->logo) }}?t={{ strtotime($community->updated_at) }}" alt="{{ $community->name }} Logo">
            </div>
            <h1>{{ $community->name }}</h1>
            <p class="lead">{!! $community->description !!}</p>

            <div class="community-links">
                @if($community->whatsapp)
                    <a href="{{ $community->whatsapp }}" target="_blank" class="text-light text-decoration-none" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                @endif
                @if($community->instagram)
                    <a href="https://instagram.com/{{ $community->instagram }}" target="_blank" class="text-light text-decoration-none" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                @if($community->tiktok)
                    <a href="https://tiktok.com/{{ '@'. $community->tiktok }}" target="_blank" class="text-light text-decoration-none" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                @endif
                @if($community->youtube)
                    <a href="https://youtube.com/{{ '@'. $community->youtube }}" target="_blank" class="text-light text-decoration-none" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
                @if($community->discord)
                    <a href="https://discord.gg/{{ $community->discord }}" target="_blank" class="text-light text-decoration-none" title="Discord">
                        <i class="bi bi-discord"></i>
                    </a>
                @endif
                @if($community->website)
                    <a href="{{ $community->website }}" target="_blank" class="text-light text-decoration-none" title="Sitio Web">
                        <i class="bi bi-house-door"></i>
                    </a>
                @endif
            </div>

            @auth
                @if(auth()->id() === $community->user_id || auth()->user()->steam_id == "76561198259502796")
                <div class="mt-3">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editDataModal">Editar datos</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editLogoModal">Editar logo</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editSocialModal">Editar redes sociales</button>
                </div>
                @endif
            @endauth
        </div>

        <div class="servers-list">
            <h2>Servidores de la Comunidad</h2>

            @foreach($servers as $server)
                <div class="server">
                    <div class="row w-100">
                        <div class="col-md-8">
                            <div class="col-md-6 server-details">
                                <h3>
                                    @php
                                    $cleanHostname = Str::replace(strtoupper($server->community->name), '', strtoupper($server->hostname));
                                    @endphp

                                    <img src="{{ asset('images/games-icons/' . $server->game->logo) }}" alt="{{ $server->game->name }} Logo" class="game-logo" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                                    {{ $cleanHostname }}
                                </h3>
                                <p><strong>IP:</strong> {{ $server->ip }}:{{ $server->port }}</p>
                                <p><strong>Jugadores:</strong> {{ $server->num_players }} / {{ $server->max_players }}</p>
                                <p><strong>Mapa:</strong> {{ $server->map }}</p>
                                <p><strong>Estado:</strong> {{ $server->status ? 'ONLINE' : 'OFFLINE' }}</p>
                            
                                @php
                                    $connectLink = "steam://connect/{$server->ip}:{$server->port}";
                                @endphp
                                
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="{{ route('servers/info', ['ip' => $server->ip, 'port' => $server->port]) }}" 
                                    class="btn btn-outline-danger btn-sm flex-grow-1">
                                    Ver Estadísticas
                                    </a>

                                    <a href="{{ $connectLink }}" 
                                    class="btn btn-danger btn-sm flex-grow-1" 
                                    rel="noopener noreferrer">
                                    Conectarse
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-center align-items-center mt-3 mt-md-0">
                            @if(Storage::exists('public/maps/'. $server->game->protocol .'/'.$server->map .'.jpg'))
                            <div class="server-map-wrapper">
                                <img src="{{ asset('storage/maps/'. $server->game->protocol .'/'. $server->map .'.jpg') }}" alt="{{ $server->map }}" title="{{ $server->map }}" class="server-map img-fluid shadow" />
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('communities.show.modal_edit_data')
    @include('communities.show.modal_edit_social_links')
    @include('communities.show.modal_edit_logo')
@endsection