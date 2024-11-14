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
}
