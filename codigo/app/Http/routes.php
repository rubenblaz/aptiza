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
      
//Rutas principales
    Route::group(['middleware' => ['web']], function () {
        
        //Ruta raiz
        Route::get('/', function(){
            if(Session::has('USUARIO')){
                return View::make('inicio');
            }else{
                return View::make('login');
            }
        });
        
        //Rutas Login 
        Route::get('inicio','Usuarios@inicio')->middleware(['validarRol']);
        Route::post('login','Usuarios@inicio')->middleware(['autenticarUsuario']); 
        Route::get('tipoinicio','Usuarios@tipoinicio')->middleware(['validarRol']);
        Route::post('elegirinicio','Usuarios@inicio')->middleware(['tipoInicioSesion']);
        Route::get('errorlogin','Usuarios@errorlogin');
        Route::get('logout','Usuarios@logout');
        
        //Rutas recuperar pass por email
        Route::get('reestablecepass',['as'=>'reestablecepass','uses'=>'Recuperarpass@nuevoPassEmail']);
        Route::post('cambiarpass','Recuperarpass@cambiarPassEmail');
        Route::match(array('GET', 'POST'),'pediremailpass','Recuperarpass@pedirPassEmail');
         
     });
    
//Rutas de Administrador
    Route::group(['middleware' => ['web','validarRol:0']], function () {
        
    });
    
//Rutas de Profesor
    Route::group(['middleware' => ['web','validarRol:1']], function () {
        
        //Rutas de reservas
        Route::get('toreservas', ['as' => 'toreservas', 'uses' =>'Reservas\Reservas@store']);
        Route::post('ajax','Reservas\Reservas@ajaxconsulta');
        Route::get('tomisreservas','Reservas\Reservas@misreservas');
        Route::get('delreserva', ['as' => 'delreserva', 'uses' => 'Reservas\Reservas@reservaborrar']);
        Route::match(array('GET', 'POST'),'reservar', 'Reservas\Reservas@hacerReserva');
    });

