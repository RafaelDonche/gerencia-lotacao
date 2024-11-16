<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspacoCafe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome', 'lotacao'
    ];

    protected $guarded = [
        'created_at', 'update_at', 'deleted_at'
    ];

    protected $primaryKey = 'id';

    protected $table = 'espaco_cafes';

    public function pessoas_intervalo1()
    {
        return $this->hasMany(Pessoa::class, 'id_primeiro_intervalo', 'id');
    }

    public function pessoas_intervalo2()
    {
        return $this->hasMany(Pessoa::class, 'id_segundo_intervalo', 'id');
    }

    // retorna a porcentagem média de lotação entre os intervalos 1 e 2
    public function media_lotacao()
    {
        $qnt_intervalo1 = count($this->pessoas_intervalo1);
        $qnt_intervalo2 = count($this->pessoas_intervalo2);

        $porcentagem_intervalo1 = $qnt_intervalo1 != 0 ? ($qnt_intervalo1/$this->lotacao) * 100 : 0;
        $porcentagem_intervalo2 = $qnt_intervalo2 != 0 ? ($qnt_intervalo2/$this->lotacao) * 100 : 0;

        return ($porcentagem_intervalo1 + $porcentagem_intervalo2) / 2;
    }
}
