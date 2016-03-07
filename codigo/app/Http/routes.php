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

});

//Rutas de Administrador
Route::group(['middleware' => ['web', 'validarRol:0']], function () {
    Route::get('admininicio', 'Usuarios@inicio');

    Route::get('/admin-aulas/', ['as' => 'admin-aulas', 'uses' => 'reservas\reservasAdminController@mostrar_aulas']);
    Route::post('/admin-aulas/aula_creada', 'reservas\reservasAdminController@crear_aulas');
    Route::get('/admin-aulas/aula_eliminada/{AULA}', array('uses' => 'reservas\reservasAdminController@eliminar_aula'));
    Route::post('/admin-aulas/aula_editar', array('uses' => 'reservas\reservasAdminController@editar_aula'));

    Route::get('/admin-horas/', ['as' => 'admin-horas', 'uses' => 'reservas\reservasAdminController@mostrar_horas']);
    Route::post('/admin-horas/hora_editar', array('uses' => 'reservas\reservasAdminController@editar_hora'));
    Route::get('/admin-horas/hora_eliminada/{NUMHORA}', 'reservas\reservasAdminController@eliminar_horas');
    Route::post('/admin-horas/hora_creada', 'reservas\reservasAdminController@crear_horas');

    Route::get('/admin-usuarios/', ['as' => 'admin-usuarios', 'uses' => 'admin\UsuarioController@index']);
    Route::post('/admin-usuarios/create', 'admin\UsuarioController@crear');
    Route::get('/admin-usuarios/listar/', 'admin\UsuarioController@listar');
    Route::get('/admin-usuarios/eliminar/{EMAIL}', array('uses' => 'admin\UsuarioController@eliminar'));
    Route::get('/admin-usuarios/editar/{EMAIL}', ['as' => 'admin-usuarios/editar', 'uses' => 'admin\UsuarioController@editar']);
    Route::post('/admin-usuarios/actualizar/', array('uses' => 'admin\UsuarioController@actualizar'));
    /**
     * Rutas admin FCT
     */
    Route::get('/altaempresas', 'FCT\Admin\otros@urlempresas'); //Alta empresas
    Route::get('/modempresas', 'FCT\Admin\otros@urlmodempresas'); //Modificacion empresas
    Route::match(array('GET', 'POST'), 'alta', 'FCT\usuarios@alta'); //Submit alta empresas
    Route::get('/modempresas2/{CIF}', 'FCT\Admin\otros@modempresas'); //Pasar por get el CIF de la empresa a modificar
    Route::match(array('GET', 'POST'), 'modempresas_submit', 'FCT\Admin\otros@modempresas_submit'); //Submit alta empresas

});

//Rutas de Profesor
Route::group(['middleware' => ['web', 'validarRol:1']], function () {
    //Rutas de reservas
    Route::get('toreservas', ['as' => 'toreservas', 'uses' => 'Reservas\Reservas@store']);
    Route::post('ajax', 'Reservas\Reservas@ajaxconsulta');
    Route::get('tomisreservas', 'Reservas\Reservas@misreservas');
    Route::get('delreserva', ['as' => 'delreserva', 'uses' => 'Reservas\Reservas@reservaborrar']);
    Route::match(array('GET', 'POST'), 'reservar', 'Reservas\Reservas@hacerReserva');
});

//Rutas de profesor FCT
Route::group(['middleware' => ['web', 'validarRol:3']], function () {
    //Rutas de FCT
    Route::get('/practicas', 'FCT\usuarios@practicas', ['as' => 'practicas']); //Asignar empresas a alumnos
    Route::get('/consulta', 'FCT\usuarios@consulta'); //Todas las empresas
    Route::get('/informe1', 'FCT\PdfController@invoice'); //PDF
    Route::get('/borrar/{CIF}', 'FCT\usuarios@borrar_empresa'); //Borrar empresa de favoritas
    Route::match(array('GET', 'POST'), 'validado2', 'FCT\usuarios@practicas_elegir'); //Asignar empresas a alumnos submit
    Route::match(array('GET', 'POST'), 'validado3', 'FCT\usuarios@empresas_favoritas'); //Submit de empresas favoritas
    Route::get('/memoria', 'FCT\usuarios@memoriafinal'); //Memoria final
    Route::get('pdf', 'FCT\PdfController@invoice'); //PDF
    Route::get('/resumenalumnos', 'FCT\usuarios@resumenalumnos');
    Route::get('/resumenempresas', 'FCT\usuarios@resumenempresas');
    Route::get('/solencuestas', 'FCT\usuarios@solencuestas');
    Route::get('/enviardatos/{CIF}', 'FCT\usuarios@enviaremail');
    Route::match(array('GET', 'POST'), 'generarexcel1', 'FCT\usuarios@generar_excel'); //Submit de empresas favoritas
    Route::resource('excel','ExcelController');

});

//Rutas de empresas FCT
Route::group(['middleware' => ['web', 'validarRol:4']], function () {
    //Rutas de FCT
    Route::get('/encuestas4', 'FCT\encuestas@urlencuestas'); //URL encuestas
    //Route::get('/admincuenta', 'FCT\Admin\otros@admincuenta'); //URL admin cuenta
    //Route::match(array('GET', 'POST'), 'validado4', 'FCT\Admin\otros@admincuenta2'); //Administrar mi cuenta
    Route::match(array('GET', 'POST'), 'validado5', 'FCT\encuestas@encuestas'); //Insertar resultados encuestas
});


//Rutas de alumno FCT
Route::group(['middleware' => ['web', 'validarRol:6']], function () {
    //Rutas de FCT
    Route::get('/encuestas6', 'FCT\encuestas@urlencuestas'); //URL encuestas
    //Route::get('/admincuenta', 'FCT\Admin\otros@admincuenta'); //URL admin cuenta
    //Route::match(array('GET', 'POST'), 'validado4', 'FCT\Admin\otros@admincuenta2'); //Administrar mi cuenta
    Route::match(array('GET', 'POST'), 'validado5', 'FCT\encuestas@encuestas'); //Insertar resultados encuestas
});