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
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text" placeholder="Informe o nome de identificação"
                        name="nome" value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div><br>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
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
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Lotação</th>
                                <th>Primeira <br> etapa</th>
                                <th>Segunda <br> etapa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salas as $sala)
                                <tr>
                                    <td>{{ $sala->nome }}</td>
                                    <td>{{ $sala->lotacao }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" data-toggle="modal" data-target="#modalEditar{{ $sala->id }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir{{ $sala->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @include('components.modals.salas')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('#datatable').DataTable({
            oLanguage: {
                sLengthMenu: "Mostrar _MENU_ registros por página",
                sZeroRecords: "Nenhum registro encontrado",
                sInfo: "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                sInfoEmpty: "Mostrando 0 / 0 de 0 registros",
                sInfoFiltered: "(filtrado de _MAX_ registros)",
                sSearch: "Pesquisar: ",
                oPaginate: {
                    sFirst: "Início",
                    sPrevious: "Anterior",
                    sNext: "Próximo",
                    sLast: "Último"
                }
            },
        });
    });
</script>
@endsection
