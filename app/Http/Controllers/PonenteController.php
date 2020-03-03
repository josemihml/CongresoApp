<?php

namespace App\Http\Controllers;

use App\Congreso;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\PonenteRequest;
use Illuminate\Support\Facades\Auth;

class PonenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $users = User::where('tipo','ponente')
            ->orderBy('name', 'desc')
            ->take(40)
            ->get();
        
        return view('ponentes/ponente')->with(['usuarios' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponentes/create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PonenteRequest $request)
    {
        
        $input=$request->validated();
        $ponente=new User($input);
        $ponente->name = $request -> get ("user_name");
        $ponente->email = $request -> get("user_mail");
        $ponente->password= Hash::make('ponentepassword');
        $ponente->tipo = "ponente";
        $fecha = Carbon::now();
        $fechaS =$fecha->toDateTimeString();
        $ponente->email_verified_at= $fechaS;
        $ponente->created_at = $fechaS;
        try {
            $ponente->save();
        } catch(\Exception $e) {
           
        }
    
        return redirect(route('ponente.index'))->with('message', 'Ponente agregado con exito'); ;
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('ponentes/edit')->with(['user' => $user]);  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Congreso  $congreso
     * @return \Illuminate\Http\Response
     */
    public function update(PonenteRequest $request, $id)
    {
         try{
             $user = Auth::user();
            dd($id);
             $user->name = $request['user_name'];
             $user->email = $request['user_email'];
        }catch(\Exception $e){
            dd($request['name']);
            return redirect('ponente/'. $user->id . '/edit') ->withErrors($error) -> withInput();
        }
        return redirect(route('ponente.index'));
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
        return redirect(route('ponente.index'))->with(['result'=>$result ,'op'=>'destroy'])->with('message', 'Ponente eliminado con exito');   
    }
}
