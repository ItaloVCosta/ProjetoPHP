<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerbaIndenizatoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDeputado',
        'Mes',
        'NomeDeputado',
        'Valor'
    ];
}
