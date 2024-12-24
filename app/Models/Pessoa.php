<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome', 'sobrenome', 'id_primeira_sala', 'id_segunda_sala',
        'id_primeiro_intervalo', 'id_segundo_intervalo'
    ];

    protected $guarded = [
        'created_at', 'update_at', 'deleted_at'
    ];

    protected $primaryKey = 'id';

    protected $table = 'pessoas';

    public function primeira_sala()
    {
        return $this->belongsTo(Sala::class, 'id_primeira_sala');
    }

    public function segunda_sala()
    {
        return $this->belongsTo(Sala::class, 'id_segunda_sala');
    }

    public function primeiro_intervalo()
    {
        return $this->belongsTo(EspacoCafe::class, 'id_primeiro_intervalo');
    }

    public function segundo_intervalo()
    {
        return $this->belongsTo(EspacoCafe::class, 'id_segundo_intervalo');
    }

    public function cadastro_completo()
    {
        if (($this->id_primeira_sala != null) &&
            ($this->id_segunda_sala != null) &&
            ($this->id_primeiro_intervalo != null) &&
            ($this->id_segundo_intervalo != null)) {
            return true;
        }else {
            return false;
        }
    }

    public static function filtrar($request)
    {
        $pessoas = Pessoa::where(function ($query) use($request) {
            if (isset($request->id)) {
                $query->where('id', $request->id);
            }
            if (isset($request->nome)) {
                $query->where('nome', 'like', '%'. $request->nome .'%');
            }
            if (isset($request->sobrenome)) {
                $query->where('nome', 'like', '%'. $request->sobrenome .'%');
            }
        })
        ->get();

        return $pessoas;
    }
}
