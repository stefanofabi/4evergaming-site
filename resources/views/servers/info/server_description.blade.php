<div class="card @if (empty($server->description)) d-none @endif">    
    <div class="card-header">
        <div> <h4 class="text-center fw-bold"> Descripción </h4> </div>
    </div>    

    <div class="card-body">
        <div class="container p-0"> {!! $server->description !!} </div>
    </div>
</div>
