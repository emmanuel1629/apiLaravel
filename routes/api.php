<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//===============Clientes============================777

    Route::get('/clients','App\Http\Controllers\ClientController@index');
    Route::post('/clients','App\Http\Controllers\ClientController@store');
    Route::get('/clients/{client}','App\Http\Controllers\ClientController@show');
    Route::put('/clients/{client}','App\Http\Controllers\ClientController@update');
    Route::delete('/clients/{client}','App\Http\Controllers\ClientController@destroy');

    //crear una ruta de tipo post que apunte a una funcion del controlador
    //de clientes llamadaq attach(Agregar/Adjuntar)
    Route::post('/clients/service','App\Http\Controllers\ClientController@attach');

    //crear una ruta de tipo post que apunte a una funcion del controlador
    //de clientes llamada detach(/Eliminar)
    Route::post('/clients/service/detach','App\Http\Controllers\ClientController@detach');

//===============Servicios===========================777

    Route::get('/services','App\Http\Controllers\ServiceController@index');
    Route::get('/services/{service}','App\Http\Controllers\ServiceController@show');
    Route::post('/services','App\Http\Controllers\ServiceController@store');
    Route::put('/services/{service}','App\Http\Controllers\ServiceController@update');
    Route::delete('/services/{service}','App\Http\Controllers\ServiceController@destroy');

    //crear una ruta de tipo post que apunte a una funcion del controlador
    //de clientes llamada detach(/Eliminar)
    Route::post('/service/clients','App\Http\Controllers\ServiceController@clients');

//===============Autenticacion===========================777
    Route::post('/register','App\Http\Controllers\Auth\AuthController@register');
    Route::post('/login','App\Http\Controllers\Auth\AuthController@login');
   
    //Rutas protegidas
        //Si solo queremos proteger una ruta añadimos la funcion middleware y pasamos como parametro el 
        //nombre del middleware que creamos y añadimos a el kernel
        
        //Proteger un grup de rutas
        Route::middleware('JWTVerify')->group(function()
        {
            Route::get('usuarios','App\Http\Controllers\UserController@index');
        });

