<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
	return str_random (32);
});

//Usuarios


//Empleados
$router->get('empleados',['uses' => 'EmpleadosController@index']);
$router->get('empleados/{id}',['uses' => 'EmpleadosController@show']);
$router->post('empleados',['middleware' => 'cors', 'uses' => 'EmpleadosController@store']);
$router->put('empleados/{id}',['uses' => 'EmpleadosController@update']);
$router->delete('empleados/{id}',['uses' => 'EmpleadosController@destroy']);

//Usuarios
$router->get('usuarios',['uses' => 'UsuariosController@index']);
$router->get('usuarios/{id}',['uses' => 'UsuariosController@show']);
$router->post('usuarios',['uses' => 'UsuariosController@store']);
$router->put('usuarios/{id}',['uses' => 'UsuariosController@update']);
$router->delete('usuarios/{id}',['uses' => 'UsuariosController@destroy']);

//Telefonos
$router->get('telefonos',['uses' => 'TelefonosController@index']);
$router->get('telefonos/{id}',['uses' => 'TelefonosController@show']);
$router->post('telefonos',['uses' => 'TelefonosController@store']);
$router->put('telefonos/{id}',['uses' => 'TelefonosController@update']);
$router->delete('telefonos/{id}',['uses' => 'TelefonosController@destroy']);