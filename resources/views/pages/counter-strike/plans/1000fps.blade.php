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
            @foreach ($slot_1000fps_price->filter(function ($item) { return $item->sortorder % 2 == 0; }) as $slot_1000fps)
            <tr>
                <td> 
                    {{ explode("|", $slot_1000fps->optionname)[1] }} 
                    @if ($slot_1000fps->sortorder == 8) <span class="badge text-bg-success"> Ideal para practicar </span> @endif
                    @if ($slot_1000fps->sortorder == 12) <span class="badge text-bg-danger"> Más vendido </span> @endif
                    @if ($slot_1000fps->sortorder == 20) <span class="badge text-bg-success"> Ideal para Mod Deathmatch </span> @endif  
                    @if ($slot_1000fps->sortorder == 24) <span class="badge text-bg-success"> Ideal para Mods exigentes </span> @endif 
                </td>
                <td>  ${{ $slot_1000fps->monthly }}/mes </td>
                <td class="text-end"> 
                    <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-1000fps?currency=2" target="_blank" class="text-dark"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </a> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 
</div>