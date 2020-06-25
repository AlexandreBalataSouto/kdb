<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoKarateca extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_foto_karateca';

    protected $dates = ['deleted_at'];

    protected $table = 'fotos_karatecas';

    protected $guarded = ['id_foto_karateca'];

    public function karateca(){
        return $this->belongsTo('App\Karateca','karateca_id');
    }
}
