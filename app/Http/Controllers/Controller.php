<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	//Respuestas Usuarios
    public function crearRespuestaIndexUsuario($datos, $codigo){
    	return response()->json(['Consulta General Usuarios'=>$datos, 'Codigo'=>200],$codigo);
    }

    public function crearRespuestaShowUsuario($datos, $codigo){
    	return response()->json(['Consulta Individual Usuarios'=>$datos, 'Codigo'=>200],$codigo);
    }


    //Respuestas Empleados
    public function crearRespuestaIndexEmpleado($datos, $codigo){
    	return response()->json(['Consulta General Empleados'=>$datos, 'Codigo'=>200],$codigo);
    }

    public function crearRespuestaShowEmpleado($datos, $codigo){
    	return response()->json(['Consulta Individual Empleados'=>$datos, 'Codigo'=>200],$codigo);
    }


    //Respuestas telefonos
    public function crearRespuestaIndexTelefono($datos, $codigo){
    	return response()->json(['Consulta General Telefonos'=>$datos, 'Codigo'=>200],$codigo);
    }

    public function crearRespuestaShowTelefono($datos, $codigo){
    	return response()->json(['Consulta Individual Telefonos'=>$datos, 'Codigo'=>200],$codigo);
    }

    public function noAutorizadoJson($mensaje, $codigo){
        return response()->json(['Mensaje de Error'=>$mensaje, "Codigo de Error"=>$codigo],$codigo);
    }

    //Elminar registros
    public function eliminarRegistro($mensaje, $codigo){
        return response()->json(['Mensaje'=>$mensaje, "Codigo"=>$codigo],$codigo);
    }
}
