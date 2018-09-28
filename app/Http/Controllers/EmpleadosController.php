<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
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
         $empleado = Empleado::all();
         return $this->crearRespuestaIndexEmpleado($empleado, 200);
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }


    function show(Request $request, $id)
    {
        if ($request->isJson()){
            $empleado = Empleado::findOrFail($id);
            return $this->crearRespuestaShowEmpleado($empleado, 200);
        }
        return response()->json(['error'=> 'No autorizado'],401);
    }


    function store(Request $request)
    {
        $this->validacion($request);
        if ($request->isJson()){
            $data = $request->json()->all();
            $empleado = Empleado::create([
                'cedula'=> $data['cedula'],
                'nombres'=> $data['nombres'] ,
                'apellidos'=> $data['apellidos'],
                'direccion'=> $data['direccion'],
                'correo'=> $data['correo'],
            ]);
            return response()->json ($empleado, 201) ;
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }


    function update(Request $request, $id)
    {
        if ($request->isJson()){
            $empleado = Empleado::findOrFail($id);
            $empleado->fill($request->all());
            $empleado->save();
            return response()->json ($empleado, 201) ;
        }

        return response()->json(['error' => 'No autorizado'], 401);
    }


    function destroy(Request $request, $id){
        if($request->isJson()){
            $empleado = Empleado::findOrFail($id);
            $empleado->delete();
            return $this->eliminarRegistro('Registro Eliminado',200);
        }
        return response()->json(['error' => 'No autorizado'], 401);
    }

    public function validacion($request){
        $reglas=[
            'cedula'=> 'required|min:10|max:13',
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'direccion'=> 'required',
            'correo'=> 'required',
        ];
        $this->validate($request, $reglas);
    }
}
