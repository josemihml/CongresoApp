<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistentePonencia extends Model
{
    protected $table = 'asistente_ponencias';
    
    public $timestamps = true; //sólo si la tabla no va a tener los campos created_at y updated_at
    
    protected $hidden = ['created_at','updated_at']; //sólo si hay campos que no se deben mostrar
    protected $fillable = ['id_asistente','id_ponencia','pagado','documento']; //para definir los campos
    
    public function ponencia() {
        return $this->belongsTo('App\Congreso', 'id_ponencia');
    }
    
    public function asistente() {
        return $this->belongsTo('App\User', 'id_asistente');
    }
}
