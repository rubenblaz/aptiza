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
    Route::get('/', function () {
        if (Session::has('USUARIO')) {
            return View::make('inicio');
        } else {
            return View::make('login');
        }
    });

    //Rutas Login
    Route::get('inicio', 'Usuarios@inicio')->middleware(['validarRol']);
    Route::post('login', 'Usuarios@inicio')->middleware(['autenticarUsuario']);
    Route::get('tipoinicio', 'Usuarios@tipoinicio')->middleware(['validarRol']);
    Route::post('elegirinicio', 'Usuarios@inicio')->middleware(['tipoInicioSesion']);
    Route::get('errorlogin', 'Usuarios@errorlogin');
    Route::get('logout', 'Usuarios@logout');

    //Rutas recuperar pass por email
    Route::get('reestablecepass', ['as' => 'reestablecepass', 'uses' => 'Recuperarpass@nuevoPassEmail']);
    Route::post('cambiarpass', 'Recuperarpass@cambiarPassEmail');
    Route::match(array('GET', 'POST'), 'pediremailpass', 'Recuperarpass@pedirPassEmail');
    //Perfil usuario

    Route::get('/perfilUsuario/', ['as' => 'perfilUsuario', 'uses' => 'Usuarios@perfilUsuario']);
    Route::post('/perfilUsuario/editar', ['as' => 'perfilUsuario/editar', 'uses' => 'Usuarios@editarPerfil']);
    Route::post('/perfilUsuario/editarPassword', ['as' => 'perfilUsuario/editarPassword', 'uses' => 'Usuarios@editarPassword']);

});

//Rutas de Administrador
Route::group(['middleware' => ['web', 'validarRol:0']], function () {
    Route::get('admininicio', 'Usuarios@inicio');

    Route::get('/admin-aulas/', ['as' => 'admin-aulas', 'uses' => 'reservas\ReservasAdminController@mostrar_aulas']);
    Route::post('/admin-aulas/aula_creada', 'reservas\ReservasAdminController@crear_aulas');
    Route::get('/admin-aulas/aula_eliminada/{AULA}', array('uses' => 'reservas\ReservasAdminController@eliminar_aula'));
    Route::post('/admin-aulas/aula_editar', array('uses' => 'reservas\ReservasAdminController@editar_aula'));

    Route::get('/admin-horas/', ['as' => 'admin-horas', 'uses' => 'reservas\ReservasAdminController@mostrar_horas']);
    Route::post('/admin-horas/hora_editar', array('uses' => 'reservas\ReservasAdminController@editar_hora'));
    Route::get('/admin-horas/hora_eliminada/{NUMHORA}', 'reservas\ReservasAdminController@eliminar_horas');
    Route::post('/admin-horas/hora_creada', 'reservas\ReservasAdminController@crear_horas');

    Route::get('/admin-usuarios/', ['as' => 'admin-usuarios', 'uses' => 'admin\UsuarioController@index']);
    Route::post('/admin-usuarios/create', 'admin\UsuarioController@crear');
    Route::get('/admin-usuarios/listar/', 'admin\UsuarioController@listar');
    Route::get('/admin-usuarios/eliminar/{EMAIL}', array('uses' => 'admin\UsuarioController@eliminar'));
    Route::get('/admin-usuarios/editar/{EMAIL}', ['as' => 'admin-usuarios/editar',
        'uses' => 'admin\UsuarioController@editar']);
    Route::get('/admin-usuarios/formPassword/{EMAIL}', ['as' => 'admin-usuarios/formPassword',
        'uses' => 'admin\UsuarioController@formPassword']);
    Route::post('/admin-usuarios/cambiarPassword/', ['as' => 'admin-usuarios/cambiarPassword',
        'uses' => 'admin\UsuarioController@cambiarPassword']);
    Route::post('/admin-usuarios/actualizar/', array('uses' => 'admin\UsuarioController@actualizar'));

    Route::get('/importacion', array('uses' => 'admin\ImportController@formImportacion'));
    Route::post('/importacion/guardarArchivo', array('uses' => 'admin\ImportController@guardarArchivo'));

});

//Rutas de Profesor
Route::group(['middleware' => ['web', 'validarRol:1']], function () {

    //Rutas de reservas
    Route::get('toreservas', ['as' => 'toreservas', 'uses' => 'reservas\reservas@store']);
    Route::post('ajax', 'reservas\reservas@ajaxconsulta');
    Route::get('tomisreservas', 'reservas\reservas@misreservas');
    Route::get('delreserva', ['as' => 'delreserva', 'uses' => 'reservas\reservas@reservaborrar']);
    Route::match(array('GET', 'POST'), 'reservar', 'reservas\reservas@hacerReserva');
});

