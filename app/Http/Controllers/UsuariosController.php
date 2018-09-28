<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;

class UsuariosController extends Controller
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
         $usuario = Usuario::all();
         return $this->crearRespuestaIndexUsuario($usuario, 200);
        }
        return $this->noAutorizadoJson('No autorizado',401);
        //return response()->json(['error'=> 'No autorizado'],401);
    }


    function show(Request $request, $id)
    {
        if ($request->isJson()){
            $usuario = Usuario::findOrFail($id);
            return $this->crearRespuestaShowUsuario($usuario, 200);
        }
        return response()->json(['error'=> 'No autorizado'],401);
    }


    function store(Request $request)
    {
        $this->validacion($request);
        if ($request->isJson()){
            $data = $request->json()->all();
            $usuario = Usuario::create([
                'usuario'=> $data['usuario'],
                'clave'=> Hash::make($data['clave']) ,
            ]);
            return response()->json ($usuario, 201) ;
        }
        //return response()->json(['error' => 'No autorizado'], 401);
    }


    function update(Request $request, $id)
    {
        if ($request->isJson()){
            $usuario = Usuario::find($id);
            $usuario->fill($request->all());
            $usuario->save();
            return response()->json ($usuario, 201) ;
        }

        return response()->json(['error' => 'No autorizado'], 401);
    }


    function destroy(Request $request, $id){
        if($request->isJson()){
            $usuario = Usuario::find($id);
            $usuario->delete();
            return $this->eliminarRegistro('Registro Eliminado',200);
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }

    public function validacion($request){
        $reglas=[
            'usuario'=> 'required',
            'clave'=> 'required|min:6',
        ];
        $this->validate($request, $reglas);
    }

}
