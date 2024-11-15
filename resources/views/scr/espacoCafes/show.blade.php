@extends('layouts.main')

@section('content')

<style>
    .lotacao-max {
        font-size: 16px;
        text-transform: uppercase;
        font-weight: bold;
        color: black;
    }
</style>

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">
            <a class="btn btn-secondary btn-pill float-start" href="{{ route('espacoCafes.index') }}">Voltar</a>
            Gerencie os participantes de cada intervalo do espaço <strong>{{ $espaco->nome }}</strong>
        </h2>
        <p class="text-center text-muted" style="margin-top: -1.5rem">Lotação máxima: <strong>{{ $espaco->lotacao }}</strong></p>
    </div>
    <div class="card-body mb-3">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Adicionar participante no primeiro intervalo</h4>
                    <hr class="mt-0">
                </div>
                @if (count($espaco->pessoas_intervalo1) < $espaco->lotacao)
                    <form action="{{ route('espacoCafes.vincularParticipantesIntervalo1', $espaco->id) }}" method="post" class="form_prevent_multiple_submits">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="pessoas_intervalo1">Participantes disponíveis</label>
                            <select class="form-control select2-multiple @error('pessoas_intervalo1') is-invalid @enderror"
                                name="pessoas_intervalo1[]" multiple="multiple">
                                @foreach ($disponiveisIntervalo1 as $d)
                                    <option value="{{ $d->id }}"
                                        @if(old('pessoas_intervalo1'))
                                            {{ in_array($d->id, old('pessoas_intervalo1')) ? 'selected' : '' }}
                                        @endif
                                        >{{ $d->nome }} {{ $d->sobrenome }}</option>
                                @endforeach
                            </select>
                            @error('pessoas_intervalo1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary submit-button" type="submit">Salvar</button>
                        </div>
                    </form>
                @else
                    <div class="col-md-12">
                        <p class="lotacao-max">O primeiro intervalo já está com lotação máxima!</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Adicionar participante no segundo intervalo</h4>
                    <hr class="mt-0">
                </div>
                @if (count($espaco->pessoas_intervalo2) < $espaco->lotacao)
                <form action="{{ route('espacoCafes.vincularParticipantesIntervalo2', $espaco->id) }}" method="post" class="form_prevent_multiple_submits">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="pessoas_intervalo2">Participantes disponíveis</label>
                        <select class="form-control select2-multiple @error('pessoas_intervalo2') is-invalid @enderror"
                            name="pessoas_intervalo2[]" multiple="multiple">
                            @foreach ($disponiveisIntervalo2 as $d)
                                <option value="{{ $d->id }}"
                                    @if(old('pessoas_intervalo2'))
                                        {{ in_array($d->id, old('pessoas_intervalo2')) ? 'selected' : '' }}
                                    @endif
                                    >{{ $d->nome }} {{ $d->sobrenome }}</option>
                            @endforeach
                        </select>
                        @error('pessoas_intervalo2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary submit-button" type="submit">Salvar</button>
                    </div>
                </form>
                @else
                    <div class="col-md-12">
                        <p class="lotacao-max">A segunda etapa já está com lotação máxima!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Listagem de participantes da primeira etapa ({{ count($espaco->pessoas_intervalo1) }}/{{ $espaco->lotacao }})</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nome e sobrenome</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($espaco->pessoas_intervalo1 as $pessoa)
                                    <tr>
                                        <td>{{ $pessoa->nome }} {{ $pessoa->sobrenome }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularPrimeiraEtapa', $pessoa->id) }}">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Listagem de participantes da segunda etapa ({{ count($espaco->pessoas_intervalo2) }}/{{ $espaco->lotacao }})</h4>
                    <hr class="mt-0">
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nome e sobrenome</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($espaco->pessoas_intervalo2 as $pessoa)
                                    <tr>
                                        <td>{{ $pessoa->nome }} {{ $pessoa->sobrenome }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-danger"
                                                onclick="desvincular(this)"
                                                rota="{{ route('pessoas.desvincularSegundaEtapa', $pessoa->id) }}">
                                                <i class="fas fa-trash"></i> Desvincular
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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
    // Função para desvincular a pessoa da sala
    function desvincular(element) {

        var rota = $(element).attr('rota');

        $(element).attr('disabled', 'true'); // impede um segundo clique

        $.ajax({ // envia a requisição para a rota que vem do botão, essa rota retorna um json
            url: rota,
            dataType: 'json',
            success: (data) => { // se der certo, mostra mensagem de sucesso, depois exclui o item
                var closestTr = $(element).closest('tr');

                closestTr.html(`
                    <td colspan="3" class="text-center alert-success">` + data + `</td>
                `);

                setTimeout(() => {
                    $(closestTr).fadeOut();
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
