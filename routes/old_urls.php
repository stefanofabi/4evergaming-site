<?php

Route::get('hosting/web/cpanel', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2');
});

Route::get('hosting/web/dominios', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/dominios?currency=2');
});

Route::get('hosting/games/counter-strike', function () {
    return redirect('games/counter-strike');
});

Route::get('hosting/games/counter-strike-source', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/counter-strike?currency=2');
});

Route::get('hosting/games/counter-strike-global-offensive', function () {
    return redirect('games/counter-strike-global-offensive');
});

Route::get('hosting/games/half-life-2-deathmatch', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/half-life/half-life-2-deathmatch?currency=2');
});

Route::get('hosting/games/team-fortress-2', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/team-fortress/team-fortress-ii?currency=2');
});

Route::get('hosting/games/team-fortress-classic', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/team-fortress/team-fortress-classic?currency=2');
});

Route::get('hosting/games/san-andreas-multi-player', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/grand-theft-auto/san-andreas-multi-player-samp?currency=2');
});

Route::get('hosting/games/multi-theft-auto', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/grand-theft-auto/multi-theft-auto-mta?currency=2');
});

Route::get('hosting/games/garrys-mod', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/sandbox-y-supervivencia/garrys-mod?currency=2');
});

Route::get('hosting/games/earths-special-forces', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-de-dragon-ball-z/earths-special-forces?currency=2');
});

Route::get('hosting/games/minecraft', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/minecraft/minecraft-java?currency=2');
});

Route::get('hosting/games/minecraft-bedrock', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/minecraft/minecraft-bedrock?currency=2');
});

Route::get('hosting/games/call-of-duty-2', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/call-of-duty/call-of-duty-2?currency=2');
});

Route::get('hosting/games/medal-of-honor-allied-assault', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/shooters/medal-of-honor-allied-assault?currency=2');
});

Route::get('hosting/games/scp-secret-laboratory', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/shooter-terror-game/scp-secret-laboratory?currency=2');
});

Route::get('hosting/games/iosoccer', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-de-futbol?currency=2');
});

Route::get('hosting/games/project-zomboid', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-de-zombies-and-vampiros/project-zomboid?currency=2');
});

Route::get('hosting/games/assetto-corsa', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-de-carreras-and-competicion/assetto-corsa?currency=2');
});

Route::get('hosting/games/valheim', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/sandbox-y-supervivencia/valheim?currency=2');
});

Route::get('hosting/games/v-rising', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-de-zombies-and-vampiros/v-rising?currency=2');
});

Route::get('hosting/vps/windows', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2');
});

Route::get('hosting/vps/linux', function () {
    return redirect()->away('https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2');
});

Route::get('sobrenosotros/datacenter', function () {
    return redirect()->away('https://4evergaming.com.ar');
});

Route::get('sobrenosotros/mitigacion', function () {
    return redirect()->away('https://4evergaming.com.ar');
});

Route::get('contacto', function () {
    return redirect()->away('https://4evergaming.com.ar');
});

