<?php

namespace App\Http\Controllers;

use App\Congreso;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\ComiteRequest;
use Illuminate\Support\Facades\Auth;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::where('tipo','comite')
            ->orderBy('name', 'desc')
            ->take(40)
            ->get();
        
        return view('comites/comite')->with(['usuarios' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comites/create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComiteRequest $request)
    {
        $input=$request->validated();
        $comite=new User($input);
        $comite->name = $request -> get ("user_name");
        $comite->email = $request -> get("user_mail");
        $comite->password= Hash::make('comitepassword');
        $comite->tipo = "comite";
        $fecha = Carbon::now();
        $fechaS =$fecha->toDateTimeString();
        $comite->email_verified_at= $fechaS;
        $comite->created_at = $fechaS;
        try {
            $comite->save();
        } catch(\Exception $e) {
           
        }
    
        return redirect(route('comite.index'))->with('message', 'Comite agregado con exito'); ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Congreso  $congreso
     * @return \Illuminate\Http\Response
     */
    public function show(Congreso $congreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Congreso  $congreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Congreso $congreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Congreso  $congreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Congreso $congreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Congreso  $congreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{  
             $user = User::find($id);
             $user->delete();
             $result = true;
        }catch(\Exception $e){
            dd($e);
            $result=false;
        
        }
        return redirect(route('comite.index'))->with(['result'=>$result ,'op'=>'destroy']);  
    }
}
