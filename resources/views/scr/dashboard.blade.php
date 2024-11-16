@extends('layouts.main')

@section('content')

<style>
    .gray-card {
        background-color: #e4e4e4;
        color: rgb(31, 31, 31);
        font-size: 15px;
    }

    .badge-soft-secondary {
        color: black;
        font-size: 18px;
    }

    .section-title {
        color: black;
    }

    hr {
        border-color: rgba(0, 0, 0, 0.658);
    }
</style>

<div class="card">
    <div class="card-hearder">
        <h2 class="text-title">Bem Vindo!</h2>
    </div>
    <div class="card-body py-0">
        <div class="row">
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                class="badge badge-soft-secondary me-2 mb-2">{{ count($pessoas) }}</span>
                            <p class="mb-2">Pessoas cadastradas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                    class="badge badge-soft-secondary me-2 mb-2">{{ count($salas) }}</span>
                                <p class="mb-2">Salas cadastradas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                class="badge badge-soft-secondary me-2 mb-2">{{ count($espacos) }}</span>
                            <p class="mb-2">Espaços de café cadastrados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-6 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-end p-3">
                            <div class="col-6">
                                <canvas id="ocupacao-sala-chart" width="400" height="100"></canvas>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-soft-secondary me-2 mb-2" id="mediaSala"></span>
                                <p class="mb-2">Ocupação média das salas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xxl-6 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-end p-3">
                            <div class="col-6">
                                <canvas id="ocupacao-espaco-chart" width="400" height="100"></canvas>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-soft-secondary me-2 mb-2" id="mediaEspaco"></span>
                                <p class="mb-2">Ocupação média dos espaços de café</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body py-0">
        <h2 class="section-title">Pessoas</h2>
        <hr class="mt-0">
        <div class="row">
            <div class="col-md-6">
                <div class="col-12">
                    <div class="card gray-card">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-start">
                                <div class="pl-3 py-3">
                                    <span
                                        class="badge badge-soft-secondary me-2 mb-2">{{ $totalPessoasCompletos }}</span>
                                    <p class="mb-2">Participantes com cadastro completo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card gray-card">
                        <div class="card-body p-1">
                            <div class="d-flex align-items-start">
                                <div class="pl-3 py-3">
                                    <span
                                        class="badge badge-soft-secondary me-2 mb-2">{{ $totalPessoasincompletos }}</span>
                                    <p class="mb-2">Participantes com cadastro incompleto</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-12">
                    <div class="card gray-card">
                        <div class="card-body p-1">
                            <div class="pt-3 px-3">
                                <canvas id="alocacao-pessoa-chart" width="100%" height="160px"></canvas>
                            </div>
                            <div class="pt-3 px-3 text-center">
                                <p class="">Distribuição de participantes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body py-0">
        <h2 class="section-title">Salas</h2>
        <hr class="mt-0">
        <div class="row">
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                    class="badge badge-soft-secondary me-2 mb-2">{{ $qntSalasCheias }}</span>
                                <p class="mb-2">Salas cheias</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                    class="badge badge-soft-secondary me-2 mb-2">{{ $qntSalasCheiasEtapa1 }}</span>
                                <p class="mb-2">Salas cheias na primeira etapa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 pl-3 py-3">
                                <span
                                    class="badge badge-soft-secondary me-2 mb-2">{{ $qntSalasCheiasEtapa2 }}</span>
                                <p class="mb-2">Salas cheias na segunda etapa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex">
                <div class="card flex-fill gray-card">
                    <div class="card-body p-1">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 py-1 text-center">
                                <span class="badge badge-soft-secondary">{{ $qntSalasVazias }}</span>
                                Total de salas vazias
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .teste {
        color: #2c2cff;
    }
</style>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById("ocupacao-sala-chart").getContext("2d");
        const ctx2 = document.getElementById("ocupacao-espaco-chart").getContext("2d");
        const ctx3 = document.getElementById("alocacao-pessoa-chart").getContext("2d");

        $.ajax({
            url: `{{ route('obterDados') }}`,
            dataType: 'json',
            success: (data) => {
                new Chart(ctx, {
                    type: "doughnut",
                    data: {
                        labels: ["Ocupado", "Desocupado"],
                        datasets: [{
                            backgroundColor: ["#2C6E49", "#bebebe"],
                            data: [data.mediaSala, data.mediaSalaResto],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                new Chart(ctx2, {
                    type: "doughnut",
                    data: {
                        labels: ["Ocupado", "Desocupado"],
                        datasets: [{
                            backgroundColor: ["#2C6E49", "#bebebe"],
                            data: [data.mediaEspaco, data.mediaEspacoResto],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                document.getElementById('mediaSala').innerHTML = data.mediaSalaFormatada + "%";
                document.getElementById('mediaEspaco').innerHTML = data.mediaEspacoFormatada + "%";

                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: ["1° etapa", "2° etapa", "1° intervalo", "2° intervalo"],
                        datasets: [
                            {
                                label: 'Participantes alocados',
                                data: data.alocacaoPessoas,
                                borderColor: "#2c2cff",
                                backgroundColor: "#2c2cff9c",
                                borderWidth: 2,
                                borderRadius: 5
                            }
                        ]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    },
                });

            },
            error: (data) => {
                console.log(data);
            }
        });
    });
</script>
@endsection
