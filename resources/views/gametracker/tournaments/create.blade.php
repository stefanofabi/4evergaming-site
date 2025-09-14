<!-- Modal HTML -->
<div class="modal fade" id="createTournamentModal" tabindex="-1" aria-labelledby="createTournamentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content gamer-style">
            <div class="modal-header gamer-style">
                <h5 class="modal-title gamer-style" id="createTournamentModalLabel">🎮 Crear Nuevo Torneo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('tournaments/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del torneo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="game_id" class="form-label">Juego</label>
                        <select class="form-select" id="game_id" name="game_id" required>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="single">Individual</option>
                            <option value="team">Por equipos</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger gamer-style">🚀 Crear Torneo</button>
                </div>
            </form>
        </div>
    </div>
</div>
