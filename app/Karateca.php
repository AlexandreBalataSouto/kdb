<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Karateca extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $primaryKey = 'id_karateca';

    protected $guarded = ['id_karateca'];

    protected $dates=['deleted_at'];

    protected $softCascade=['fotosKarateca','documentos'];


    public function getNombreCompletoAttribute() 
    {
         return "{$this->nombre} {$this->apellidos}";
    }
    
    public function monitor(){
        return $this->belongsTo('App\Monitor','monitor_id');
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria','categoria_id');
    }

    public function fotosKarateca(){
        return $this->hasMany('App\FotoKarateca','karateca_id');
    }

    public function documentos(){
        return $this->hasMany('App\Documento','karateca_id');
    }

    public function faltas(){
        return $this->hasMany('App\Falta','karateca_id');
    }

    public function cursos(){
        return $this->belongsToMany('App\Curso');
    }
    
    public function competiciones(){
        return $this->belongsToMany('App\Competicion','competiciones_karatecas','competicion_id','karateca_id')->withTimestamps();
    }
}
