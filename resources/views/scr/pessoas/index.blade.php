@extends('layouts.main')

@section('content')

<style>
    .badge {
        /* font-size: .825rem; */
        padding: .3em .3em
    }
</style>

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">Gerencie os participantes do treinamento</h2>
    </div>
    <div class="card-body mb-3">
        <form action="{{ route('pessoas.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Adicionar uma nova pessoa</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text" placeholder="Informe o nome"
                        name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="sobrenome">Sobrenome</label>
                    <input class="form-control @error('sobrenome') is-invalid @enderror" type="text" placeholder="Informe o sobrenome"
                        name="sobrenome" value="{{ old('sobrenome') }}">
                    @error('sobrenome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="id_primeira_sala">Sala da primeira etapa</label>
                    <select class="form-control select2 @error('id_primeira_sala') is-invalid @enderror" name="id_primeira_sala">
                        <option value="" selected></option>
                        @foreach ($disponiveisEtapa1 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_primeira_sala') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_primeira_sala')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="id_segunda_sala">Sala da segunda etapa</label>
                    <select class="form-control select2 @error('id_segunda_sala') is-invalid @enderror" name="id_segunda_sala">
                        <option value="" selected></option>
                        @foreach ($disponiveisEtapa2 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_segunda_sala') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_segunda_sala')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="id_primeiro_intervalo">Espaço de café do primeiro intervalo</label>
                    <select class="form-control select2 @error('id_primeiro_intervalo') is-invalid @enderror" name="id_primeiro_intervalo">
                        <option value="" selected></option>
                        @foreach ($disponiveisIntervalo1 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_primeiro_intervalo') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_primeiro_intervalo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="id_segundo_intervalo">Espaço de café do segundo intervalo</label>
                    <select class="form-control select2 @error('id_segundo_intervalo') is-invalid @enderror" name="id_segundo_intervalo">
                        <option value="" selected></option>
                        @foreach ($disponiveisIntervalo2 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_segundo_intervalo') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_segundo_intervalo')
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
                <h4>Listagem de pessoas cadastradas</h4>
                <hr class="mt-0">
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nome e sobrenome</th>
                                <th>Salas</th>
                                <th>Espaços de café</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pessoas as $pessoa)
                                <tr>
                                    <td>
                                        {{ $pessoa->nome }} {{ $pessoa->sobrenome }} <br>
                                        @if ($pessoa->cadastro_completo())
                                            <span class="badge badge-success">(cadastro completo)</span>
                                        @else
                                            <span class="badge badge-danger">(cadastro imcompleto)</span>
                                        @endif
                                    </td>
                                    <td>
                                        Primeira etapa: <strong>{{ $pessoa->id_primeira_sala != null ? $pessoa->primeira_sala->nome : '- não definido -' }}</strong> <br>
                                        Segunda etapa: <strong>{{ $pessoa->id_segunda_sala != null ? $pessoa->segunda_sala->nome : '- não definido -' }}</strong>
                                    </td>
                                    <td>
                                        Primeiro intervalo: <strong>{{ $pessoa->id_primeiro_intervalo != null ? $pessoa->primeiro_intervalo->nome : '- não definido -' }}</strong> <br>
                                        Segundo intervalo: <strong>{{ $pessoa->id_segundo_intervalo != null ? $pessoa->segundo_intervalo->nome : '- não definido -' }}</strong>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" href="{{ route('pessoas.edit', $pessoa->id) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir{{ $pessoa->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- modal de exclusão --}}
                                <div class="modal fade" id="modalExcluir{{ $pessoa->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header btn-danger">
                                                <h3 style="color: white">Tem certeza que deseja excluir a pessoa <strong>{{ $pessoa->nome }} {{ $pessoa->sobrenome }}</strong>?</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('pessoas.destroy', $pessoa->id) }}" method="POST">
                                                @csrf
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
