<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $primaryKey = 'id_curso';
    protected $keyType = 'string';
    //Al usar Google Calendar voy a cambiar el como se establece los id en cursos y competiciones
    public $incrementing = false;
    
    protected $fillable=['id_curso','numero','title','start','end','hora','descripcion','precio','color'
    ,'text_color','monitor_id'];
    
    public function monintor(){
        return $this->belongsTo('App\Monitor','monitor_id');
    }

    public function karatecas(){
        return $this->belongsToMany('App\Karateca','cursos_karatecas','curso_id','karateca_id')->withTimestamps();
    }
    
}
