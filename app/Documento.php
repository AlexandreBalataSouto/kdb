<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_documento';

    protected $dates = ['deleted_at'];

    protected $guarded = ['id_documento'];

    public function karateca(){
        return $this->belongTo('App\Karateca','karateca_id');
    }
}
