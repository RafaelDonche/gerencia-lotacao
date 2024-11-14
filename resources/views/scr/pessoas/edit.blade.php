@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">
            <a class="btn btn-secondary btn-pill float-start" href="{{ route('pessoas.index') }}">Voltar</a>
            Edição do participante <strong>{{ $pessoa->nome }}</strong>
        </h2>
    </div>
    <div class="card-body mb-3">
        <form action="{{ route('pessoas.update', $pessoa->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h4>Adicionar uma nova pessoa</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text"
                        name="nome" value="{{ $pessoa->nome }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="sobrenome">Sobrenome</label>
                    <input class="form-control @error('sobrenome') is-invalid @enderror" type="text"
                        name="sobrenome" value="{{ $pessoa->sobrenome }}">
                    @error('sobrenome')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" id="div-etapa1" style="{{ $pessoa->id_primeira_sala != null ? 'display: none;' : '' }}">
                    <label class="form-label" for="id_primeira_sala">Sala da primeira etapa</label>
                    <select class="form-control select2 @error('id_primeira_sala') is-invalid @enderror" name="id_primeira_sala"
                        {{ $pessoa->id_primeira_sala != null ? 'disabled' : '' }}>
                        <option value="" selected></option>
                        @foreach ($disponiveisEtapa1 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_primeira_sala') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_primeira_sala')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" id="div-etapa2" style="{{ $pessoa->id_segunda_sala != null ? 'display: none;' : '' }}">
                    <label class="form-label" for="id_segunda_sala">Sala da segunda etapa</label>
                    <select class="form-control select2 @error('id_segunda_sala') is-invalid @enderror" name="id_segunda_sala"
                        {{ $pessoa->id_segunda_sala != null ? 'disabled' : '' }}>
                        <option value="" selected></option>
                        @foreach ($disponiveisEtapa2 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_segunda_sala') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_segunda_sala')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" id="div-intervalo1" style="{{ $pessoa->id_primeiro_intervalo != null ? 'display: none;' : '' }}">
                    <label class="form-label" for="id_primeiro_intervalo">Espaço de café do primeiro intervalo</label>
                    <select class="form-control select2 @error('id_primeiro_intervalo') is-invalid @enderror" name="id_primeiro_intervalo"
                        {{ $pessoa->id_primeiro_intervalo != null ? 'disabled' : '' }}>
                        <option value="" selected></option>
                        @foreach ($disponiveisIntervalo1 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_primeiro_intervalo') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_primeiro_intervalo')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-3" id="div-intervalo2" style="{{ $pessoa->id_segundo_intervalo != null ? 'display: none;' : '' }}">
                    <label class="form-label" for="id_segundo_intervalo">Espaço de café do segundo intervalo</label>
                    <select class="form-control select2 @error('id_segundo_intervalo') is-invalid @enderror" name="id_segundo_intervalo"
                        {{ $pessoa->id_segundo_intervalo != null ? 'disabled' : '' }}>
                        <option value="" selected></option>
                        @foreach ($disponiveisIntervalo2 as $d)
                            <option value="{{ $d->id }}"
                                {{ $d->id == old('id_segundo_intervalo') ? 'selected' : '' }}>
                                {{ $d->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_segundo_intervalo')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <a href=""></a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Listagem de salas que o participante está vinculado</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Etapa</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($pessoa->id_primeira_sala))
                                    <tr>
                                        <td>{{ $pessoa->primeira_sala->nome }}</td>
                                        <td>Primeira etapa</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularPrimeiraEtapa', $pessoa->id) }}"
                                                nome-div="div-etapa1">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                @if (isset($pessoa->id_segunda_sala))
                                    <tr>
                                        <td>{{ $pessoa->segunda_sala->nome }}</td>
                                        <td>Segunda etapa</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularSegundaEtapa', $pessoa->id) }}"
                                                nome-div="div-etapa2">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Listagem de espaços de café que o participante está vinculado</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Intervalo</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($pessoa->id_primeiro_intervalo))
                                    <tr>
                                        <td>{{ $pessoa->primeiro_intervalo->nome }}</td>
                                        <td>Primeiro intervalo</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularPrimeiroIntervalo', $pessoa->id) }}"
                                                nome-div="div-intervalo1">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                                @if (isset($pessoa->id_segundo_intervalo))
                                    <tr>
                                        <td>{{ $pessoa->segundo_intervalo->nome }}</td>
                                        <td>Segundo intervalo</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularSegundoIntervalo', $pessoa->id) }}"
                                                nome-div="div-intervalo2">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // Função para desvincular a pessoa da sala ou espaço de café
    function desvincular(element) {

        var rota = $(element).attr('rota');
        var nomeDiv = $(element).attr('nome-div');

        $(element).attr('disabled', 'true'); // impede um segundo clique

        $.ajax({// envia a requisição para a rota que vem do botão, essa rota retorna um json
            url: rota,
            dataType: 'json',
            success: (data) => { // se der certo, mostra mensagem de sucesso, depois exclui o item e mostra o select
                var closestTr = $(element).closest('tr');
                var div = $('#' + nomeDiv);
                var select = div.find('select').first();

                closestTr.html(`
                    <td colspan="3" class="text-center alert-success">` + data + `</td>
                `);

                setTimeout(() => {
                    $(closestTr).fadeOut();
                    select.removeAttr('disabled');
                    div.fadeIn();
                }, "1000");
            },
            error: (data) => { // se der errado, mostra mensagem de erro genérica
                var closestTr = $(element).closest('tr');

                closestTr.html(`
                    <td colspan="3" class="text-center alert-danger">Houve um erro ao tentar desvincular, tente novamente!</td>
                `);
            }
        });
    }
</script>

@endsection
