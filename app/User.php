<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNombreSoloAttribute(){
        $array = explode(" ",$this->name);

        if(count($array) < 4){
            return $array[0];
        }else if(count($array) >= 4){
            return $array[0]." ".$array[1];
        }
    }

    public function getApellidosSoloAttribute(){
        $array = explode(" ",$this->name);

        if(count($array) == 2){
            return $array[1];
        }else if(count($array) == 3){
            return $array[1]." ".$array[2];
        }else if(count($array) >= 4){
            return $array[2]." ".$array[3];
        }else{
            return "";
        }
    }
}

