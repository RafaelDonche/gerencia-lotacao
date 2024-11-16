<?php

namespace App\Services;

class MathService
{
    // Retorna valor inteiro se for inteiro e arrendondado em duas casas se for decimal
    function formatarPorcentagem($numero) {

        if (floor($numero) == $numero) {
            return (int) $numero;
        }

        return number_format($numero, 2, ',', '');
    }
}
