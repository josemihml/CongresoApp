<?php

namespace App\Http\Controllers;

use App\Ponencia;
use App\Congreso;
use App\User as User;
use App\AsistentePonencia;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests\PonenciaRequest;

use Barryvdh\DomPDF\Facade as PDF;

class PonenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ponencia = Ponencia::paginate(6);
        
        $asistentePonencia = AsistentePonencia::All();
        
        $users = User::All();
        
        $congreso = Congreso::All();
        
        return view('ponencias/ponencia')->with(['ponencias' => $ponencia, 'congresos' => $congreso, 'ponentes' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $congreso = Congreso::All();
         
         return view('ponencias/create')->with(['congresos' => $congreso]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PonenciaRequest $request)
    {
        $input=$request->validated();
        $ponencia=new Ponencia($input);
        $ponencia->image= $request->file('file')->getClientOriginalName();
        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $target = '../public/assets/img/';
            $name = $file->getClientOriginalName();
            $file->move($target, $name);
 
        }
        
        $url = $request -> get('video_ponencia');
        $ponencia->video_ponencia = $this->YoutubeID($url);
        
        $ponencia->nombre_ponencia = $request -> get ("nombre_ponencia");
        $ponencia->descripcion_ponencia = $request -> get ("descripcion_ponencia");
        $ponencia->fecha_ponencia = $request -> get ("fecha_ponencia");
        $ponencia->precio_ponencia = $request -> get ("precio_ponencia");
      
        $ponencia->id_congreso = $request -> get("id_congreso");
        $ponencia->id_ponente = Auth::user()->id;
        

        try {
            $result=$ponencia->save();
        } catch(\Exception $e) {
        
        }
    
        return redirect(route('ponencia.index'))->with('message', 'Ponencia agregada con exito');  ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ponencia  $ponencia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $congreso = Congreso::All();
        $users = User::All();
        $ponencia= Ponencia::find($id);
        $asistente = AsistentePonencia::All();
        
        
        return view('ponencias.show')->with(['ponencia'=>$ponencia, 'congresos'=> $congreso , 'ponentes'=>$users, 'asistentes' => $asistente]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ponencia  $ponencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
         $congreso = Congreso::All();
         $ponencia= Ponencia::find($id);
         
         return view('ponencias/edit')->with(['ponencia'=>$ponencia , 'congresos'=>$congreso])->with('message', 'Ponencia editada con exito');  ;  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponencia  $ponencia
     * @return \Illuminate\Http\Response
     */
    public function update(PonenciaRequest $request, $id)
    {
         $input = $request->validated();
         $ponencia = Ponencia::find($id);
         try{
            /* echo $id;
             echo $ponencia;
             exit;*/
            $result = $ponencia->update($input);
        }catch(\Exception $e){
            $error=['nombre'=>'El nombre utilizado ya existe en otro producto.'];
            return redirect('ponencia/'. $ponencia->id . '/edit') ->withErrors($error) -> withInput();
        }
        return redirect(route('ponencia.index'))->with(['result'=>$result,'op'=>'update'])->with('message', 'Ponencia actualizada con exito');  ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponencia  $ponencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       try{
          $ponencia= Ponencia::find($id);
             $ponencia->delete();
             $result=true;
        }catch(\Exception $e){
            
            $result=false;
            var_dump($e);
            exit;
        }
        return redirect(route('ponencia.index'))->with(['result'=>$result ,'op'=>'destroy'])->with('message', 'Ponencia eliminada con exito');  
    }
    
    
    public function downloadPDF($id) {
        $ponencia = Ponencia::find($id);
        
        $data=[
            'ponencia' => $ponencia,
            'name' => 'Certificado Congreso BA',
            ];
        
        $pdf = PDF::loadView('ponencias.pdf', $data);
    
        
        return $pdf->download('ponencias.pdf');
    }
    
    
    function pago($id){
        $ponencia = Ponencia::find($id);
        $asistente = new AsistentePonencia();
        $asistente->id_asistente = Auth::user()->id;
        $asistente->id_ponencia = $ponencia->id;
        $asistente->documento = 'descargado';
        $asistente->pagado = true ;
        $asistente->save();
        
        return redirect()->back()->with('message', 'Pago realizado');
     
    }
    
    
    
    function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }
}
