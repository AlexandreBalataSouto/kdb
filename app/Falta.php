<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    protected $primaryKey = 'id_falta';

    protected $guarded = ['id_falta'];

    public function karateca(){
        return $this->belongsTo('App\Karateca','karateca_id');
    }
}
