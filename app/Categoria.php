<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $primaryKey = 'id_categoria';

    public function karatecas(){
        return $this->hasMany('App\Karateca','categoria_id');
    }
}
