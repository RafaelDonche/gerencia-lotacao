<?php

namespace App\Http\Controllers;

use App\Models\EspacoCafe;
use App\Models\Pessoa;
use App\Models\Sala;
use App\Services\MathService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        try {

            $math = new MathService();

            $salas = Sala::get(); // todas as salas
            $espacos = EspacoCafe::get(); // todos os espaços de café
            $pessoas = Pessoa::get(); // todas as pessoas

            // total de pessoas com cadastro completo
            $totalPessoasCompletos = Pessoa::whereNotNull('id_primeira_sala')
                ->whereNotNull('id_segunda_sala')
                ->whereNotNull('id_primeiro_intervalo')
                ->whereNotNull('id_segundo_intervalo')
                ->count();

            // total de pessoas com cadastro incompleto
            $totalPessoasincompletos = Pessoa::whereNull('id_primeira_sala')
                ->orWhereNull('id_segunda_sala')
                ->orWhereNull('id_primeiro_intervalo')
                ->orWhereNull('id_segundo_intervalo')
                ->count();

            $arrayMediasSalas = [];
            $qntSalasCheias = 0;
            $qntSalasCheiasEtapa1 = 0;
            $qntSalasCheiasEtapa2 = 0;
            $qntSalasVazias = 0;
            foreach ($salas as $sala) {
                array_push($arrayMediasSalas, $sala->media_lotacao());
                $qntSalasCheias = $sala->lotada() ? $qntSalasCheias + 1 : $qntSalasCheias;
                $qntSalasCheiasEtapa1 = $sala->etapa1_lotada() ? $qntSalasCheiasEtapa1 + 1 : $qntSalasCheiasEtapa1;
                $qntSalasCheiasEtapa2 = $sala->etapa2_lotada() ? $qntSalasCheiasEtapa2 + 1 : $qntSalasCheiasEtapa2;
                $qntSalasVazias = $sala->vazia() ? $qntSalasVazias + 1 : $qntSalasVazias;
            }

            $arrayMediasEspacos = [];
            foreach ($espacos as $espaco) {
                array_push($arrayMediasEspacos, $espaco->media_lotacao());
            }

            $mediaLotacaoSalas = $math->formatarPorcentagem(array_sum($arrayMediasSalas) / count($arrayMediasSalas));
            $mediaLotacaoEspacos = $math->formatarPorcentagem(array_sum($arrayMediasEspacos) / count($arrayMediasEspacos));

            return view('scr.dashboard', compact(
                'salas', 'espacos', 'pessoas',
                'totalPessoasCompletos', 'totalPessoasincompletos', 'mediaLotacaoSalas', 'mediaLotacaoEspacos',
                'qntSalasCheias', 'qntSalasCheiasEtapa1', 'qntSalasCheiasEtapa2', 'qntSalasVazias'
            ));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function obterDados()
    {
        try {

            $math = new MathService();

            $salas = Sala::get(); // todas as salas
            $espacos = EspacoCafe::get(); // todos os espaços de café

            $arrayMediasSalas = [];
            foreach ($salas as $sala) {
                array_push($arrayMediasSalas, $sala->media_lotacao());
            }

            $arrayMediasEspacos = [];
            foreach ($espacos as $espaco) {
                array_push($arrayMediasEspacos, $espaco->media_lotacao());
            }

            $mediaLotacaoSalas = array_sum($arrayMediasSalas) / count($arrayMediasSalas);
            $mediaLotacaoEspacos = array_sum($arrayMediasEspacos) / count($arrayMediasEspacos);

            $mediaLotacaoSalasFormatada = $math->formatarPorcentagem($mediaLotacaoSalas);
            $mediaLotacaoEspacosFormatada = $math->formatarPorcentagem($mediaLotacaoEspacos);

            $qntPessoasEtapa1 = Pessoa::whereNotNull('id_primeira_sala')->count();
            $qntPessoasEtapa2 = Pessoa::whereNotNull('id_segunda_sala')->count();
            $qntPessoasIntervalo1 = Pessoa::whereNotNull('id_primeiro_intervalo')->count();
            $qntPessoasIntervalo2 = Pessoa::whereNotNull('id_segundo_intervalo')->count();

            $retorno = new stdClass();
            $retorno->mediaSala = round($mediaLotacaoSalas, 2);
            $retorno->mediaSalaResto = round(100 - $mediaLotacaoSalas, 2);
            $retorno->mediaSalaFormatada = $mediaLotacaoSalasFormatada;
            $retorno->mediaEspaco = round($mediaLotacaoEspacos, 2);
            $retorno->mediaEspacoResto = round(100 - $mediaLotacaoEspacos, 2);
            $retorno->mediaEspacoFormatada = $mediaLotacaoEspacosFormatada;
            $retorno->alocacaoPessoas = [$qntPessoasEtapa1, $qntPessoasEtapa2, $qntPessoasIntervalo1, $qntPessoasIntervalo2];

            return response()->json($retorno);

        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
}
