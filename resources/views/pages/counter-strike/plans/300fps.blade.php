                <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <h3 class="fw-bold mt-3"> Ideal para uso personal </h3>
                    <p> 
                        Disfrutá de todas nuestras características al precio más bajo del mercado sin reducir calidad.
                        Perfecto para jugar con amigos y divertirse un rato. 
                    </p>

                    <div class="row position-center ps-5 pe-5 mt-2">
                        <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" target="_blank" class="btn btn-danger"> Ver lista completa de precios </a>
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
                            @for ($i=4; $i <= 32; $i=$i+4)
                            <tr>
                                <td> 
                                    {{ $i }} jugadores 
                                    @if ($i == 4) <span class="badge text-bg-info"> Ideal para pruebas </span> @endif
                                    @if ($i == 12) <span class="badge text-bg-success"> Ideal para empezar </span> @endif
                                    @if ($i == 16) <span class="badge text-bg-danger">Más vendido</span> @endif 
                                    @if ($i == 24) <span class="badge text-bg-success">Ideal para servidor público</span> @endif 
                                </td>
                                <td> ${{ $i * $slot_300fps_price * $dollar_price}}/mes </td>
                                <td class="text-end"> 
                                    <a href="https://clientes.4evergaming.com.ar/store/counter-strike/counter-strike-16-300fps?currency=2" target="_blank" class="text-dark"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                    </a> 
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table> 
                </div>
                