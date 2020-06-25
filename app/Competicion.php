<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competicion extends Model
{
    protected $primaryKey = 'id_competicion';
    protected $keyType = 'string';
    //Al usar Google Calendar voy a cambiar el como se establece los id en competicion y cursos
    public $incrementing = false;

    protected $fillable=['id_competicion','numero','title','start','end','hora','descripcion','precio','color'
    ,'text_color'];

    protected $table = 'competiciones';

    public function karatecas(){
        return $this->belongsToMany('App\Karateca','competiciones_karatecas','competicion_id','karateca_id')
        ->withTimestamps()
        ->withPivot('puesto');
    }
}
