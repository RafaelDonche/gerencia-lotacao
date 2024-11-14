<?php

namespace App\Rules;

use App\Models\EspacoCafe;
use Illuminate\Contracts\Validation\Rule;

class CheckLotacaoEspacoCafeRule implements Rule
{
    protected $intervalo;

    public function __construct($intervalo)
    {

        $this->intervalo = $intervalo;
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
        if ($this->intervalo != 1 && $this->intervalo != 2) {
            return false;
        }

        $espaco = EspacoCafe::findOrFail($value);

        switch ($this->intervalo) {
            case '1':
                $qnt = max(count($espaco->pessoas_intervalo1), 0);
                break;

            case '2':
                $qnt = max(count($espaco->pessoas_intervalo2), 0);
                break;

            default:
                $qnt = 0;
                break;
        }

        if ($espaco->lotacao > $qnt) {
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
        return "Este espaço de café já está lotado durante o intervalo $this->intervalo.";
    }
}
