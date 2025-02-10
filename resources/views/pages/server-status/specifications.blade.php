    <div class="mt-4">
        <h4>Especificaciones</h4>

        <ul>
            <li><strong>CPU:</strong> {{ $node->cpu_specification }} </li>
            <li><strong>RAM:</strong> {{ $node->memory_specification }} </li>
            <li><strong>Disco:</strong> {{ $node->disk_specification }} </li>
            <li><strong>Conexión:</strong> {{ $node->connection_specification }} </li>
            <li><strong>Fuente de alimentación</strong> {{ $node->power_supply_specification }} </li>
            <li><strong>Sistema operativo:</strong> {{ $node->operating_system }}</li>
            <li><strong>PHPMyAdmin:</strong> 
                @if (empty($node->phpmyadmin))
                    <a href="#"> Ingresar </a>
                @else 
                    <a href="{{ $node->phpmyadmin }}" target="_blank"> Ingresar </a> 
                @endif
            </li>
        </ul>
    </div>