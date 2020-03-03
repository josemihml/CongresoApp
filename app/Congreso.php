<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Congreso extends Model
{
    protected $table = 'congresos';

    public $timestamps = true; 
    
    protected $hidden = ['created_at','updated_at']; 
    protected $fillable = ['nombre_congreso','descripcion_congreso','ubicacion_congreso']; 
    
    public function ponencias() {
        return $this->hasMany('App\Ponencia');
    }

}
