<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'title',
        'lista_id',
        'tarefa_status_id'
    ];
}
