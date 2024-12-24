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
                <form action="{{ route('espacoCafes.vincularParticipantesIntervalo1', $espaco->id) }}" method="post" class="form_prevent_multiple_submits" id="form_intervalo1"
                    @if ($espaco->intervalo1_lotado())
                        style="display: none;"
                    @endif>
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="pessoas_intervalo1">Participantes disponíveis</label>
                        <select class="form-control select2-multiple @error('pessoas_intervalo1') is-invalid @enderror"
                            name="pessoas_intervalo1[]" id="pessoas_intervalo1" multiple="multiple">
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
                <div class="col-md-12" id="aviso_intervalo1_lotado"
                    @if (!$espaco->intervalo1_lotado())
                        style="display: none;"
                    @endif>
                    <p class="lotacao-max">O primeiro intervalo já está com lotação máxima!</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Adicionar participante no segundo intervalo</h4>
                    <hr class="mt-0">
                </div>
                <form action="{{ route('espacoCafes.vincularParticipantesIntervalo2', $espaco->id) }}" method="post" class="form_prevent_multiple_submits" id="form_intervalo2"
                    @if ($espaco->intervalo2_lotado())
                        style="display: none;"
                    @endif>
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="pessoas_intervalo2">Participantes disponíveis</label>
                        <select class="form-control select2-multiple @error('pessoas_intervalo2') is-invalid @enderror"
                            name="pessoas_intervalo2[]" id="pessoas_intervalo2" multiple="multiple">
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
                <div class="col-md-12" id="aviso_intervalo2_lotado"
                    @if (!$espaco->intervalo2_lotado())
                        style="display: none;"
                    @endif>
                    <p class="lotacao-max">A segundo intervalo já está com lotação máxima!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="col-md-12">
                    <h4>Listagem de participantes do primeiro intervalo (<span id="contador_intervalo1">{{ count($espaco->pessoas_intervalo1) }}</span>/{{ $espaco->lotacao }})</h4>
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
                                                rota="{{ route('pessoas.desvincularPrimeiroIntervalo', $pessoa->id) }}">
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
                    <h4>Listagem de participantes do segundo intervalo (<span id="contador_intervalo2">{{ count($espaco->pessoas_intervalo2) }}</span>/{{ $espaco->lotacao }})</h4>
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
                                                rota="{{ route('pessoas.desvincularSegundoIntervalo', $pessoa->id) }}">
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
                console.log(data);


                closestTr.html(`
                    <td colspan="3" class="text-center alert-success">` + data.mensagem + `</td>
                `);

                let newOption = new Option(data.nome_participante, data.id_participante, false, false);

                if (data.intervalo == 1) {
                    $('#contador_intervalo1').html(data.total);
                    $('#pessoas_intervalo1').append(newOption).trigger('change');
                    var form = $('#form_intervalo1');
                    var aviso = $('#aviso_intervalo1_lotado');
                }
                if (data.intervalo == 2) {
                    $('#contador_intervalo2').html(data.total);
                    $('#pessoas_intervalo2').append(newOption).trigger('change');
                    var form = $('#form_intervalo2');
                    var aviso = $('#aviso_intervalo2_lotado');
                }

                setTimeout(() => {
                    $(closestTr).fadeOut();
                    if (data.mostra_form) {
                        $(form).fadeIn();
                        $(aviso).fadeOut();
                    }
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
