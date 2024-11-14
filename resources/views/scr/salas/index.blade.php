@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">Gerencie as salas que ocorrerão as etapas do treinamento</h2>
    </div>
    <div class="card-body mb-3">
        <form action="{{ route('salas.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Adicionar uma nova sala</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text" placeholder="Informe o nome de identificação"
                        name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="lotacao">Lotacao</label>
                    <input class="form-control @error('lotacao') is-invalid @enderror" type="number" placeholder="Informe a lotação máxima"
                        name="lotacao" value="{{ old('lotacao') }}">
                    @error('lotacao')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Listagem de salas cadastradas</h4>
                <hr class="mt-0">
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Lotação</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salas as $sala)
                                <tr>
                                    <td>{{ $sala->nome }}</td>
                                    <td>{{ $sala->lotacao }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="{{ route('salas.show', $sala->id) }}">
                                            <i class="fas fa-eye"></i> Gerenciar participantes
                                        </a>
                                        <a class="btn btn-secondary" href="{{ route('salas.edit', $sala->id) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir{{ $sala->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- modal de exclusão --}}
                                <div class="modal fade" id="modalExcluir{{ $sala->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header btn-danger">
                                                <h3 style="color: white">Tem certeza que deseja excluir a sala <strong>{{ $sala->nome }}</strong>?</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('salas.destroy', $sala->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-md-12 text-justify">
                                                        A exclusão de uma sala resulta na desvinculação de todas as pessoas que estão
                                                        vinculadas a esta sala.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger btn-pill">Excluir</button>
                                                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-pill">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
