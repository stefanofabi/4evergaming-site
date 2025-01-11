@extends('base')

@section('description', 'Hosting VPS en Argentina! Super Potentes y con Mitigación DDoS. Activación automática. Servicio personalizable y Escalable. Soporte por WhatsApp los 365 días del año.')

@section('robots', 'index, follow')

@section('title')
4evergaming: Hosting VPS en Argentina
@endsection

@section('css')
    <style>
        body {
            background: linear-gradient(to top, #d1f2f2, #ffffff);
            font-family: Arial, sans-serif;
        }

        .hero {
            background-color: #eef9f9;
            padding: 30px 15px;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            color: #007bff;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }

        .action-buttons .btn {
            margin: 5px;
        }

        .features {
            background-color: #f8f9fa;
            padding: 30px 15px;
        }

        .features h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .features ul {
            list-style-type: none; /* Elimina los puntos */
            margin: 0; /* Elimina márgenes predeterminados */
            padding: 0; /* Elimina el padding predeterminado */
        }
        .features ul li {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
    </style>
@endsection


@section('content')
<div class="hero">
    <h1>SUBITE A LA NUBE</h1>
    <p class="fs-4">Almacenamiento SSD. Linux o Windows. Anti DDoS. 100% configurables.</p>
    <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank"> <img src="{{ asset('images/vps-hosting/intel-core-i9-fastest-desktop-processor.jpg') }}" alt="Máxima Potencia con Intel Core i9" class="img-fluid mt-2 shadow"> </a>
</div>

<div class="container py-4">
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-3 fw-bold">VPS SSD Silver</h5>
                    <p class="card-text">1 Core CPU</p>
                    <p class="card-text">1 GB RAM</p>
                    <p class="card-text">50 GB SSD SATA Storage</p>
                    <p class="card-text">50 Megas Ancho de Banda</p>
                    <p class="card-text text-success fw-bold">Intel Core i9 👌🏻💎</p>
                    <p class="card-text text-success fw-bold">Memoria  RAM 3200MHz 🚀</p>
                    <p class="card-text text-success fw-bold">Velocidad Disco 3000 MB/s ⚡</p>
                    <p class="text-primary fs-4 fw-bold">${{ 11 * $dollar_price }} ARS</p>
                    <div class="action-buttons">
                        <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" class="btn btn-primary">Pedir Ahora</a>
                        <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20información%20sobre%20servidores%20VPS" class="btn btn-success">Hablar por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repeat for other plans -->

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-3 fw-bold">VPS SSD Nova</h5>
                    <p class="card-text">2 Core CPU</p>
                    <p class="card-text">2 GB RAM</p>
                    <p class="card-text">75 GB SSD NVMe Storage</p>
                    <p class="card-text">50 Megas Ancho de Banda</p>
                    <p class="card-text text-success fw-bold">Intel Core i9 👌🏻💎</p>
                    <p class="card-text text-success fw-bold">Memoria  RAM 3200MHz 🚀</p>
                    <p class="card-text text-success fw-bold">Velocidad Disco 3000 MB/s ⚡</p>
                    <p class="text-primary fs-4 fw-bold">${{ 19 * $dollar_price }} ARS</p>
                    <div class="action-buttons">
                        <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" class="btn btn-primary">Pedir Ahora</a>
                        <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20información%20sobre%20servidores%20VPS" class="btn btn-success">Hablar por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-3 fw-bold">VPS SSD Master</h5>
                    <p class="card-text">2 Core CPU</p>
                    <p class="card-text">4 GB RAM</p>
                    <p class="card-text">100 GB SSD NVMe Storage</p>
                    <p class="card-text">100 Megas Ancho de Banda</p>
                    <p class="card-text text-success fw-bold">Intel Core i9 👌🏻💎</p>
                    <p class="card-text text-success fw-bold">Memoria  RAM 3200MHz 🚀</p>
                    <p class="card-text text-success fw-bold">Velocidad Disco 3000 MB/s ⚡</p>
                    <p class="text-primary fs-4 fw-bold">${{ 28 * $dollar_price }} ARS</p>
                    <div class="action-buttons">
                        <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" class="btn btn-primary">Pedir Ahora</a>
                        <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20información%20sobre%20servidores%20VPS" class="btn btn-success">Hablar por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-3 fw-bold">VPS SSD Guardian</h5>
                    <p class="card-text">4 Core CPU</p>
                    <p class="card-text">6 GB RAM</p>
                    <p class="card-text">100 GB SSD NVMe Storage</p>
                    <p class="card-text">100 Megas Ancho de Banda</p>
                    <p class="card-text text-success fw-bold">Intel Core i9 👌🏻💎</p>
                    <p class="card-text text-success fw-bold">Memoria  RAM 3200MHz 🚀</p>
                    <p class="card-text text-success fw-bold">Velocidad Disco 3000 MB/s ⚡</p>
                    <p class="text-primary fs-4 fw-bold">${{ 42 * $dollar_price }} ARS</p>
                    <div class="action-buttons">
                        <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" class="btn btn-primary">Pedir Ahora</a>
                        <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20información%20sobre%20servidores%20VPS" class="btn btn-success">Hablar por WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="features py-4">
    <div class="container">
        <h2>Características Principales</h2>
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li>✔ Mitigación de ataques</li>
                    <li>✔ Soporte calificado x365</li>
                    <li>✔ Acceso y control total</li>
                    <li>✔ Redes de alta velocidad</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>✔ Administración remota</li>
                    <li>✔ Recursos sin límites</li>
                    <li>✔ Infraestructura sustentable</li>
                    <li>✔ Monitoreo y administración</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>✔ Uptime garantizado</li>
                    <li>✔ Datacenter World Class</li>
                    <li>✔ Proveedores certificados</li>
                    <li>✔ Transferencia ilimitada</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container text-center py-4">
    <p class="fs-3 mb-4">¿Ningún plan se ajusta a tus necesidades? <br /> ¡Crea tu plan personalizado!</p>
    <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales/vps-ssd-personalizable?currency=2" target="_blank" class="btn btn-warning btn-lg">Personalizar Plan</a>
</div>
@endsection