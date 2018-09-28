<?php

namespace App\Http\Controllers;

use App\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TelefonosController extends Controller
{

    function __construct(){
        $this->middleware('auth',['only'=>[
            'store',
            'update',
            'destroy'
        ]]);
    }

    
	function index(Request $request)
    {
    	if ($request->isJson()){
        //Eloquent
         $telefono = Telefono::all();
         return $this->crearRespuestaIndexTelefono($telefono,200) ;
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }


    function show(Request $request, $id)
    {
        if ($request->isJson()){
            $telefono = Telefono::findOrFail($id);
            return $this->crearRespuestaShowTelefono($telefono, 200);
        }
        return response()->json(['error'=> 'No autorizado'],401);
    }


    function store(Request $request)
    {
        $this->validacion($request);
        if ($request->isJson()){
            $data = $request->json()->all();
            $telefono = Telefono::create([
                'operadora'=> $data['operadora'],
                'numero'=> $data['numero'] ,
            ]);
            return response()->json ($telefono, 201) ;
        }
        return response()->json(['error' => 'No autorizado'], 401)->setCallback($request->input('callback'));
    }


    function update(Request $request, $id)
    {
        if ($request->isJson()){
            $telefono = Telefono::find($id);
            $telefono->fill($request->all());
            $telefono->save();
            return response()->json ($telefono, 201) ;
        }

        return response()->json(['error' => 'No autorizado'], 401);
    }


    function destroy(Request $request, $id){
        if($request->isJson()){
            $telefono = Telefono::find($id);
            $telefono->delete();
            return $this->eliminarRegistro('Registro Eliminado',200);
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }


    public function validacion($request){
        $reglas=
        [
            'operadora'=> 'required',
            'numero'=> 'required|min:10',
        ];

        $this->validate($request, $reglas);
    }

}
