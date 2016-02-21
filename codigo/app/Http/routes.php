<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */
    Route::get('/', 'Usuarios@store')->middleware(['web']);
       
    //Rutas de usuario
    Route::get('errorlogin','Usuarios@errorlogin');
    Route::post('login',function(){
        return View::make('inicio');
    })->middleware(['web','autenticarUsuario']); 
    
    //Recuperar pass por email.
    Route::match(array('GET', 'POST'),'pediremailpass','Recuperarpass@pedirPassEmail');
    Route::get('reestablecepass',['as'=>'reestablecepass','uses'=>'Recuperarpass@nuevoPassEmail'])->middleware(['web']);
    Route::post('cambiarpass','Recuperarpass@cambiarPassEmail')->middleware(['web']);

    
//Middleware Group
    Route::group(['middleware' => ['web','validarRol:1']], function () {

        //Rutas de usuario
        Route::get('logout','Usuarios@logout');
        Route::get('inicio','Usuarios@inicio');
        
        //Rutas de reservas
            Route::get('toreservas', ['as' => 'toreservas', 'uses' =>'Reservas@store']);
            Route::post('ajax','Reservas@ajaxconsulta');
            Route::get('tomisreservas','Reservas@misreservas');
            Route::get('delreserva', ['as' => 'delreserva', 'uses' => 'Reservas@reservaborrar']);
            Route::match(array('GET', 'POST'),'reservar', 'Reservas@hacerReserva');
    });
