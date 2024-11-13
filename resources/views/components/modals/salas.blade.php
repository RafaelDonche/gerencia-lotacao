<div class="modal fade" id="modalEditar{{ $sala->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Editar sala</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('salas.destroy', $sala->id) }}" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control @error('nome') is-invalid @enderror" type="text"
                                name="nome" value="{{ $sala->nome }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div><br>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="lotacao">Lotacao</label>
                            <input class="form-control @error('lotacao') is-invalid @enderror" type="number"
                                name="lotacao" value="{{ $sala->lotacao }}">
                            @error('lotacao')
                                <div class="invalid-feedback">{{ $message }}</div><br>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-pill">Salvar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-pill">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExcluir{{ $sala->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-danger">
                <h3 style="color: white">Tem certeza que deseja excluir a sala <strong>{{ $sala->nome }}</strong>?</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('salas.destroy', $sala->id) }}" method="POST">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-pill">Excluir</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-pill">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
