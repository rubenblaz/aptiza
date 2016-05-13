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
    Route::get('/altaempresas', 'fct\admin\otros@urlempresas'); //Alta empresas
    Route::get('/modempresas', 'fct\admin\otros@urlmodempresas'); //Modificacion empresas
    Route::match(array('GET', 'POST'), 'alta', 'fct\usuarios@alta'); //Submit alta empresas
    Route::get('/modempresas2/{CIF}', 'fct\admin\otros@modempresas'); //Pasar por get el CIF de la empresa a modificar
    Route::match(array('GET', 'POST'), 'modempresas_submit', 'fct\admin\otros@modempresas_submit'); //Submit alta empresas
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
    Route::get('/practicas', 'fct\usuarios@practicas', ['as' => 'practicas']); //Asignar empresas a alumnos
    Route::get('/consulta', 'fct\usuarios@consulta'); //Todas las empresas
    Route::get('/informe1', 'fct\PdfController@invoice'); //PDF
    Route::get('/borrar/{CIF}', 'fct\usuarios@borrar_empresa'); //Borrar empresa de favoritas
    Route::match(array('GET', 'POST'), 'validado2', 'fct\usuarios@practicas_elegir'); //Asignar empresas a alumnos submit
    Route::match(array('GET', 'POST'), 'validado3', 'fct\usuarios@empresas_favoritas'); //Submit de empresas favoritas
    Route::get('/memoria', 'fct\usuarios@memoriafinal'); //Memoria final PDF
    Route::get('/memoria2', 'fct\usuarios@memoriafinal2'); //Memoria Excel
    Route::get('pdf', 'fct\PdfController@invoice'); //PDF de la hoja de firmas de alumnos FCT
    Route::get('pdf2', 'fct\PdfController@invoice2'); //PDF de la memoria final
    Route::match(array('GET', 'POST'), 'generarpdfmemoria', 'fct\PdfController@invoice2'); //Submit generar PDF memoria final
    Route::get('/resumenalumnos', 'fct\usuarios@resumenalumnos'); //Resumen de las encuestas de los alumnos
    Route::get('/resumenempresas', 'fct\usuarios@resumenempresas'); //Resumen de las encuestas de las empresas
    Route::get('/solencuestas', 'fct\usuarios@solencuestas');
    Route::get('/enviardatos/{CIF}', 'fct\usuarios@enviaremail');
    Route::match(array('GET', 'POST'), 'generarexcel1', 'fct\usuarios@generar_excel');
    Route::resource('excel','ExcelController');
    Route::get('/excel', 'ExcelController@store');
    Route::get('/admitirfcts' , 'fct\usuarios@practicas_admitir');
    Route::match(array('GET', 'POST'), 'validado7', 'fct\usuarios@practicas_admitir_submit');
});

//Rutas de empresas FCT
Route::group(['middleware' => ['web', 'validarRol:4']], function () {
    //Rutas de FCT
    Route::get('/encuestas4', 'fct\encuestas@urlencuestas'); //URL encuestas
    Route::match(array('GET', 'POST'), 'validado4', 'fct\encuestas@encuestas_empresas'); //Insertar resultados encuestas empresas
});


//Rutas de alumno FCT
Route::group(['middleware' => ['web', 'validarRol:6']], function () {
    //Rutas de FCT
    Route::get('/encuestas6', 'fct\encuestas@urlencuestas'); //URL encuestas
    Route::match(array('GET', 'POST'), 'validado6', 'fct\encuestas@encuestas'); //Insertar resultados encuestas alumnos
});