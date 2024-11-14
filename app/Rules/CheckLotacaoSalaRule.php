<?php

namespace App\Rules;

use App\Models\Sala;
use Illuminate\Contracts\Validation\Rule;

class CheckLotacaoSalaRule implements Rule
{
    protected $etapa;

    public function __construct($etapa)
    {

        $this->etapa = $etapa;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->etapa != 1 && $this->etapa != 2) {
            return false;
        }

        if (!Sala::where('id', $value)->exists()) {
            return false;
        }

        $sala = Sala::find($value);

        switch ($this->etapa) {
            case '1':
                $qnt = max(count($sala->pessoas_etapa1), 0);
                break;

            case '2':
                $qnt = max(count($sala->pessoas_etapa2), 0);
                break;

            default:
                $qnt = 0;
                break;
        }

        if ($sala->lotacao > $qnt) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Esta sala já está lotada durante a etapa $this->etapa.";
    }
}
