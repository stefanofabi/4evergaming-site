@extends('base')

@section('description', 'Web Hosting en Argentina! Super Potentes y con Mitigación DDoS. Activación automática. Servicio personalizable y Escalable. Soporte por WhatsApp los 365 días del año.')

@section('robots', 'index, follow')

@section('title')
4evergaming: Hosting VPS en Argentina
@endsection

@section('css')
<style>
    .banner {
        background: #002b54;
        color: white;
        text-align: center;
        padding: 50px 20px;
        position: relative;
    }
    .banner h1 {
        font-size: 3rem;
        font-weight: bold;
    }
    .banner p {
        font-size: 1.25rem;
        margin: 20px 0;
    }
    .banner .btn {
        background-color: #ff7f0e;
        color: white;
        font-size: 1.5rem;
        padding: 10px 30px;
        border-radius: 5px;
    }
    .banner .btn:hover {
        background-color: #e56c0b;
    }
</style>
@endsection

@section('content')
    <!-- Banner Section -->
    <header class="banner">
        <h1>WEB HOSTING</h1>
        <p>
            ✔ SSL, Bases de datos y Correo incluido.<br>
            ✔ Migración gratuita y asistida.<br>
            ✔ Atención al cliente 24/7.
        </p>
        <div>
            <span style="font-size: 2rem;">Desde <del>${{ 5 * $dollar_price }}</del></span>
            <h2 style="font-size: 3rem; font-weight: bold;">${{ 3 * $dollar_price }} /mes</h2>
            <p style="font-size: 1rem;">Pesos Argentinos</p>
        </div>
        <a href="#plans" class="btn">Ver planes</a>
    </header>

    <!-- Hosting Plans Section -->
    <section id="plans" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Planes de Hosting Web</h2>
            <div class="row">
                <!-- Plan 5G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 5G</h3>
                            <p class="card-text">5 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 3 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>
                                  
                                  Pedir Ahora
                            </a>
                            
                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Plan 10G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 10G</h3>
                            <p class="card-text">10 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 4 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>
                                  
                                  Pedir Ahora
                            </a>
                            
                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Plan 15G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 15G</h3>
                            <p class="card-text">15 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 5 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>

                                  Pedir Ahora
                            </a>

                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Plan 15G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 30G</h3>
                            <p class="card-text">30 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 9 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>

                                  Pedir Ahora
                            </a>

                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Plan 15G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 50G</h3>
                            <p class="card-text">50 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 14 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>

                                  Pedir Ahora
                            </a>

                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Plan 15G -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Alojamiento Web 100G</h3>
                            <p class="card-text">100 GB Disco SSD NVMe<br>Transferencia ilimitada<br>Certificado SSL<br>Cuentas y Bases de datos ilimitadas</p>
                            <h4 class="text-primary">${{ 27 * $dollar_price }} / Mensual</h4>
                            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" class="btn btn-primary mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                  </svg>

                                  Pedir Ahora
                            </a>

                            <a href="https://wa.me/5491133972764" target="_blank" class="btn btn-success mt-3"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg> 
                                
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web-premium?currency=2" target="_blank" class="btn btn-warning btn-lg">
                Si necesitas más recursos, ingresa a este link o contáctanos
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Características de Nuestros Planes</h2>
            <div class="row text-center">
                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/ssd.png') }}" alt="SSD" width="100">
                    <h4 class="mt-3">Máxima Performance</h4>
                    <p>Tu sitio vuela con la tecnología de almacenamiento 100% SSD.</p>
                </div>

                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/availability.png') }}" alt="High Availability" width="100">
                    <h4 class="mt-3">Alta Disponibilidad</h4>
                    <p>Hardware de último nivel para tu sitio web. <br />No hacemos Over Selling.</p>
                </div>

                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/support.png') }}" alt="Support" width="100">
                    <h4 class="mt-3">Soporte 24x7x365</h4>
                    <p>Nuestros expertos están a tu lado para brindarte asesoramiento y asistencia 24x7.</p>
                </div>
            </div>
            <div class="row mt-4 text-center">
                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/backup.png') }}" alt="Backup" width="100">
                    <h4 class="mt-3">Backups para tu Tranquilidad</h4>
                    <p>Hacemos copias de respaldo mensuales para tu seguridad.</p>
                </div>

                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/antivirus.png') }}" alt="Anti-Spam" width="100">
                    <h4 class="mt-3">Anti-Spam/Anti-Virus</h4>
                    <p>Basta de correos basura y sitios infectados. <br /> Auditamos tu alojamiento periódicamente.</p>
                </div>
                
                <div class="col-md-4 feature">
                    <img src="{{ asset('images/web-hosting/apps.png') }}" alt="Apps" width="100">
                    <h4 class="mt-3">Aplicaciones Gratuitas</h4>
                    <p>WordPress y otras aplicaciones listas para instalar con 1 click.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
