<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoMonitor extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_foto_monitor';

    protected $dates = ['deleted_at'];

    protected $table = 'fotos_monitores';

    protected $guarded = ['id_foto_monitor'];

    public function monitor(){
        return $this->belongsTo('App\Monitor','monitor_id');
    }
}
