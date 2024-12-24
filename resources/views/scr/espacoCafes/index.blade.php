@extends('layouts.main')

@section('content')

<style>
    .progress-bar {
        margin: 1rem 0.5rem;
        width: 40px;
        height: 18px;
        background-color: #DCDCDD;
        border-radius: 50px;
    }
    .loaded-progress {
        height: 18px;
        background-color: #2C6E49;
        border-radius: 50px;
    }
    .badge {
        font-size: .825rem;
        margin: 0 1rem;
        padding: .3em .3em
    }
</style>

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">Gerencie os espaços de café que ocorrerão os intervalos do treinamento</h2>
    </div>
    <div class="card-body mb-3">
        <form action="{{ route('espacoCafes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Adicionar um novo espaço de café</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text" placeholder="Informe o nome de identificação"
                        name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="lotacao">Lotacao</label>
                    <input class="form-control @error('lotacao') is-invalid @enderror" type="number" placeholder="Informe a lotação máxima"
                        name="lotacao" value="{{ old('lotacao') }}">
                    @error('lotacao')
                        <div class="invalid-feedback">{{ $message }}</div>
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
                <h4>Listagem de espaços de café cadastrados</h4>
                <hr class="mt-0">
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Lotação primeiro intervalo</th>
                                <th>Lotação segundo intervalo</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($espacos as $espaco)
                                <tr>
                                    <td>{{ $espaco->nome }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{ count($espaco->pessoas_intervalo1) }}
                                            <div class="progress-bar">
                                                <div class="loaded-progress" style="width: {{ $espaco->porcentagem_intervalo1() }}%;"></div>
                                            </div>
                                            {{ $espaco->lotacao }}
                                            @if ($espaco->intervalo1_lotado())
                                                <span class="badge badge-success">(lotada)</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{ count($espaco->pessoas_intervalo2) }}
                                            <div class="progress-bar">
                                                <div class="loaded-progress" style="width: {{ $espaco->porcentagem_intervalo2() }}%;"></div>
                                            </div>
                                            {{ $espaco->lotacao }}
                                            @if ($espaco->intervalo2_lotado())
                                                <span class="badge badge-success">(lotada)</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="{{ route('espacoCafes.show', $espaco->id) }}">
                                            <i class="fas fa-eye"></i> Gerenciar participantes
                                        </a>
                                        <a class="btn btn-secondary" href="{{ route('espacoCafes.edit', $espaco->id) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir{{ $espaco->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- modal de exclusão --}}
                                <div class="modal fade" id="modalExcluir{{ $espaco->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header btn-danger">
                                                <h3 style="color: white">Tem certeza que deseja excluir o espaço <strong>{{ $espaco->nome }}</strong>?</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('espacoCafes.destroy', $espaco->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-md-12 text-justify">
                                                        A exclusão de um espaço de café resulta na desvinculação de todas as pessoas que estão
                                                        vinculadas a esta espaço.
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
