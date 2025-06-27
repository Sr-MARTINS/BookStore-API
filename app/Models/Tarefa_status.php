<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa_status extends Model
{
    protected $table = 'tarefa_status';

    protected $fillable = [
        'name'
    ];
}
