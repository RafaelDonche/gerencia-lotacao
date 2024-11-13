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

    public function primero_intervalo()
    {
        return $this->belongsTo(EspacoCafe::class, 'id_primero_intervalo');
    }

    public function segundo_intervalo()
    {
        return $this->belongsTo(EspacoCafe::class, 'id_segundo_intervalo');
    }
}
