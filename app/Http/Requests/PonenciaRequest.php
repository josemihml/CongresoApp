<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PonenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
     }
     
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
          /*  'nombre_ponencia'            =>  'required | min:1 | max:100 | unique:ponencias',
            'descripcion_ponencia'       =>  'required | min:1 | max:600',
            'fecha_ponencia'             =>  'required',
            'precio_ponencia'            =>  'required | numeric',
            'video_ponencia'             =>  'required | min: | max:400 ',
            'id_congreso'                =>  'required' ,
            'id_ponente'                 =>  'required',
            'image'                      =>  'required | min:5 | max:400'*/
            
        ];
    }
}
