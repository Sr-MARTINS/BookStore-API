<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'name',
        'descricao'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,' book_id');
    }
}
