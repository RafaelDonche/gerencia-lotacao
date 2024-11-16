<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
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

    protected $table = 'salas';

    public function pessoas_etapa1()
    {
        return $this->hasMany(Pessoa::class, 'id_primeira_sala', 'id');
    }

    public function pessoas_etapa2()
    {
        return $this->hasMany(Pessoa::class, 'id_segunda_sala', 'id');
    }

    public function etapa1_lotada()
    {
        return count($this->pessoas_etapa1) >= $this->lotacao ? true : false;
    }

    public function etapa2_lotada()
    {
        return count($this->pessoas_etapa2) >= $this->lotacao ? true : false;
    }

    public function lotada()
    {
        return $this->etapa1_lotada() && $this->etapa2_lotada() ? true : false;
    }

    public function vazia()
    {
        return (count($this->pessoas_etapa1) == 0) && (count($this->pessoas_etapa2) == 0) ? true : false;
    }

    // retorna a porcentagem da lotação da etapas 1
    public function porcentagem_etapa1()
    {
        $qnt = count($this->pessoas_etapa1);

        return $qnt != 0 ? ($qnt/$this->lotacao) * 100 : 0;
    }

    // retorna a porcentagem da lotação da etapas 2
    public function porcentagem_etapa2()
    {
        $qnt = count($this->pessoas_etapa2);

        return $qnt != 0 ? ($qnt/$this->lotacao) * 100 : 0;
    }

    // retorna a porcentagem média de lotação entre as etapas 1 e 2
    public function media_lotacao()
    {
        $porcentagem_etapa1 = $this->porcentagem_etapa1();
        $porcentagem_etapa2 = $this->porcentagem_etapa2();

        return ($porcentagem_etapa1 + $porcentagem_etapa2) / 2;
    }
}
