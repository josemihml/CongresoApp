<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponencia extends Model
{
    protected $table = 'ponencias';
    
    public $timestamps = true; //sólo si la tabla no va a tener los campos created_at y updated_at
    
    protected $hidden = ['created_at','updated_at']; //sólo si hay campos que no se deben mostrar
    protected $fillable = ['nombre_ponencia','descripcion_ponencia','fecha_ponencia','precio_ponencia','video_ponencia','id_congreso','id_ponente','image']; //para definir los campos
    
    public function congreso() {
        return $this->belongsTo('App\Congreso', 'id_congreso');
    }
    
    public function ponente() {
        return $this->belongsTo('App\User', 'id_ponente');
    }
    
    public function asistentes(){
        return $this->hasMany('App\User');
    }
}
