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
}
