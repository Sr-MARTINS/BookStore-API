<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'title',
        'is_public',
        'user_id'
    ];

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}
