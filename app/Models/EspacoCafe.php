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

    public function nomes_intervalo1()
    {
        return $this->hasMany(Pessoa::class, 'id_primeiro_intervalo', 'id')->select('nome');
    }

    public function pessoas_intervalo2()
    {
        return $this->hasMany(Pessoa::class, 'id_segundo_intervalo', 'id');
    }

    public function nomes_intervalo2()
    {
        return $this->hasMany(Pessoa::class, 'id_segundo_intervalo', 'id')->select('nome');
    }

    // retorna a porcentagem da lotação do intervalos 1
    public function porcentagem_intervalo1()
    {
        $qnt = count($this->pessoas_intervalo1);

        return $qnt != 0 ? ($qnt/$this->lotacao) * 100 : 0;
    }

    // retorna a porcentagem da lotação do intervalos 2
    public function porcentagem_intervalo2()
    {
        $qnt = count($this->pessoas_intervalo2);

        return $qnt != 0 ? ($qnt/$this->lotacao) * 100 : 0;
    }

    // retorna a porcentagem média de lotação entre os intervalos 1 e 2
    public function media_lotacao()
    {
        $porcentagem_intervalo1 = $this->porcentagem_intervalo1();
        $porcentagem_intervalo2 = $this->porcentagem_intervalo2();

        return ($porcentagem_intervalo1 + $porcentagem_intervalo2) / 2;
    }

    public static function filtrar($request)
    {
        $espacos = EspacoCafe::where(function ($query) use($request) {
            if (isset($request->id)) {
                $query->where('id', $request->id);
            }
            if (isset($request->nome)) {
                $query->where('nome', 'like', '%'. $request->nome .'%');
            }
        })
        ->get();

        return $espacos;
    }
}
