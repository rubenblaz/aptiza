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
    Route::get('/',['as' => '/', 'uses' => function () {
        return view('login');
    }]);
   
    
    //Rutas de usuario
    Route::get('errorlogin', ['as' => 'errorlogin', 'uses' => 'Usuarios@errorlogin']); //Middleware aplicado a una ruta
    Route::post('inicio', ['as' => 'inicio', 'uses' => 'Usuarios@inicio'])->middleware(['web','AutenticarUsuario']); //tambien pasa por el grupo "web" para iniciar la session.
    Route::get('inicio', ['as' => 'inicio', 'uses' => 'Usuarios@inicio'])->middleware(['web','AutenticarUsuario']); //tambien pasa por el grupo "web" para iniciar la session.
    Route::post('recuperapass', ['as' => 'recuperapass', 'uses' => 'Usuarios@recuperapass']);
    Route::get('recuperapass', function(){
        return view('recuperapass');
    });
    Route::get('reestablecepass', ['as' => 'reestablecepass', 'uses' => 'Usuarios@reestablecepass'])->middleware(['web']);
    Route::post('cambiarpass',['as' => 'cambiarpass', 'uses' => 'Usuarios@cambiarpass'])->middleware(['web']);
//Middleware Group
    Route::group(['middleware' => ['web','validaciones']], function () {

        //Rutas de usuario
        Route::get('logout', 'Usuarios@logout');
        Route::get('inicio', ['as' => 'inicio', 'uses' => function(){ 
             return view('inicio');
        }]);
        
        //Rutas de reservas
            Route::get('toreservas', ['as' => 'toreservas', 'uses' =>'Reservas@store']);
            Route::get('tomisreservas',['as' => 'tomisreservas', 'uses' => 'Reservas@misreservas']);
            Route::get('delreserva', ['as' => 'delreserva', 'uses' => 'Reservas@reservaborrar']);
            Route::post('ajax', ['as' => 'ajax', 'uses' => 'Reservas@ajaxconsulta']);
            Route::match(array('GET', 'POST'),'reservar',['as' => 'reservar', 'uses' => 'Reservas@hacerReserva']);
    });
// Ejemplos
// Route::match(array('GET', 'POST'), 'validar', 'gestionusuarios@store');
