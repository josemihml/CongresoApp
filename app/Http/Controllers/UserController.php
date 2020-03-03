<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ponencia;
use App\AsistentePonencia;

class UserController extends Controller
{

   public function index(){
       
   }
   
   
   public function show($id)
   {
       $asistente= AsistentePonencia::All();
       $user= User::find($id);
       $ponencia = Ponencia::All();
       return view('user/show')->with(['user'=>$user, 'asistentes' => $asistente, 'ponencias' => $ponencia]);
   }
    
}
