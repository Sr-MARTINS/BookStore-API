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

    public function lista()
    {
        return $this->hasOne(Lista::class);
    }

        //Ligação de status
    public function condicao() 
    {
        return $this->hasOne(Tarefa_status::class);
    }
}
