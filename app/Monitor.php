<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Monitor extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $primaryKey = 'id_monitor';

    protected $table = 'monitores';

    protected $dates=['deleted_at'];

    protected $softCascade=['fotosMonitor'];

    protected $guarded = ['id_monitor'];

    public function getNombreCompletoAttribute()
     {
          return "{$this->nombre} {$this->apellidos}";
     }
    
    public function karatecas(){
        return $this->hasMany('App\Karateca','monitor_id');
    }

    public function fotosMonitor(){
        return $this->hasMany('App\FotoMonitor','monitor_id');
    }

    public function cursos(){
        return $this->hasMany('App\Curso','curso_id');
    }

}
