<?php

namespace App\Http\Controllers\FCT;

use App\Modelo\alumno;
use App\Modelo\encuesta;
use Illuminate\Http\Request;
use App\Modelo\empresa;
use App\Modelo\profesor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Hash;

class usuarios extends Controller
{
    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Recoge los datos de una empresa nueva y la crea en la bbdd.
     */
    public function alta(Request $req)
    {
        if (Session::has('mensajealta')) {
            Session::forget('mensajealta');
        }
        /*
         * Datos de alta de las empresas
         */
        $usuario_empresa = $req->get('usuario');
        $cif = $req->get('cif');
        $nombre = $req->get('nombre');
        $cp = $req->get('cp');
        $telefono = $req->get('telefono');
        $dnirep = $req->get('dnirep');
        $convenio = $req->get('convenio');
        $alias = $req->get('alias');
        $poblacion = $req->get('poblacion');
        $fax = $req->get('fax');
        $observaciones = $req->get('observaciones');
        $fechaconv = $req->get('fechaconvenio');
        $direccion = $req->get('direccion');
        $provincia = $req->get('provincia');
        $convrep = $req->get('convrep');
        $tipoempresa = $req->get('tipoempresa');
        $password = $req->get('password');
        $email = $req->get('email');
        $fechaconv_vec = date("Y-m-d", strtotime($fechaconv)); //Conversion de formato
        $fav = $req->get('favorita');
        //$password2 = $password;

        $empresa1 = new empresa();


        $existe = $empresa1->comprobarEmpresa($cif);
        $existe2 = $empresa1->comprobarUsuario($usuario_empresa);
        //$password = Hash::make($password); //Encriptar contraseña

        /*
         * Insertar los datos del formulario en la tabla de empresas
         */
        $rol = 4;
        if ($existe == false && $existe2 == false) {
            $empresa1->insertarUsuario($usuario_empresa, $password, $nombre);
            $empresa1->insertarEmpresa($usuario_empresa, $cif, $nombre, $cp, $telefono, $dnirep, $convenio, $alias, $poblacion, $fax, $observaciones, $fechaconv_vec, $direccion, $provincia, $convrep, $tipoempresa, $fav);
            /*
             * Enviar link al email
             */
            $datosemail['email'] = $usuario_empresa;
            $datosemail['pass'] = DB::table('usuarios')->select('PASS')->where('EMAIL', $usuario_empresa)->get()[0]->PASS;

            Mail::send('emails.emailfct', $datosemail, function ($message) use ($usuario_empresa) {
                $message->to($usuario_empresa)->subject('Acceso a las encuestas en Aptiza.');
            });

            /******/
            $mensaje = "ok";
            Session::put('mensajealta', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('mensajealta', $mensaje);
        }
        return redirect('altaempresas');
    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Devuelve los alumnos segun el tutor y las empresas favoritas.
     */
    public function practicas(Request $req)
    {
        $profesor1 = new profesor();
        $empresa1 = new empresa();

        $curso_tutor = $profesor1->cursoTutor(Session::get('USUARIO')->getEmail());

        $alumnos = $profesor1->misAlumnos($curso_tutor);

        //Cuenta cuantos alumnos hay
        $cantidad_alumnos = count($alumnos);
        $cont = 0;
        $vec_aux = array();
        while ($cont < $cantidad_alumnos) {
            $vec_aux[$cont] = DB::table('cursos')->select('CICLO')->where('IDCICLO', $alumnos[$cont]->CURSO)->get();
            $cont++;
        }

        $empresas_fav = $empresa1->empresasFavoritas();

        $empresas_fav_vec = array();

        foreach ($empresas_fav as $emp) {
            $empresas_fav_vec[$emp->CIF] = $emp->NOMBRE;
        }

        $datos = [
            'empresas' => $empresas_fav_vec,
            'alumnos' => $alumnos,
            'cursos' => $vec_aux
        ];
        return view('FCT/practicas', $datos);
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Asigna empresas a alumnos.
     */
    public function practicas_elegir(Request $req)
    {
        if (Session::has('operacion')) {
            Session::forget('operacion');
        }
        $empresa1 = new empresa();
        $alumno1 = new alumno();

        $seleccion_alumnos = $req->get('seleccionado'); //N_EXP de los alumnos que elige
        $seleccion_empresa = $req->get('empresas'); //Empresa que elige en el select list

        //$mensajes = array();

        $usuario_empresa = $empresa1->usuarioEmpresa($seleccion_empresa);

        $update = $alumno1->actualizarAlumnos($seleccion_alumnos, $usuario_empresa);

        if ($update) {
            $mensaje = "ok";
            Session::put('operacion', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('operacion', $mensaje);
        }

        return redirect('practicas');
    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra todas las empresas disponibles en la bbdd.
     */
    public function consulta(Request $req)
    {

        $empresa1 = new empresa();

        $todas_empresas = $empresa1->todasEmpresas();

        $datos = [
            'empresas' => $todas_empresas
        ];
        return view('FCT/consulta', $datos);
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Vuelve a las empresas favoritas
     */
    public function empresas_favoritas(Request $req)
    {
        if (Session::has('empresafav')) {
            Session::forget('empresafav');
        }

        $empresasfav = $req->get('favoritas');

        for ($i = 0; $i < count($empresasfav); $i++) {
            $update = DB::table('empresas')
                ->where('CIF', $empresasfav[$i])
                ->update(['FAVORITA' => 'SI']);
        }
        if ($update) {
            $mensaje = "ok";
            Session::put('empresafav', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('empresafav', $mensaje);
        }
        return redirect('consulta');
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Elimina una empresa de la lista de favoritas
     */
    public function borrar_empresa(Request $req)
    {
        $empresa1 = new empresa();
        $cif = $req->CIF;

        $update = $empresa1->borrarFavorita($cif);

        return redirect('consulta');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Datos para usarlos en la vista de la memoria final
     */
    public function memoriafinal()
    {
        $usuario1 = new alumno();
        $profesor1 = new profesor();

        $email_profesor = Session::get('USUARIO')->getEmail();
        $nombre_apellidos_tutor = $profesor1->obtenerNombreApellidos($email_profesor);
        $nombre_curso_tutor = $profesor1->nombreCurso($email_profesor)[0]->CICLO;
        $id_curso_tutor = $profesor1->cursoTutor($email_profesor)[0]->CURSO;

        $nombre = $nombre_apellidos_tutor[0]->NOMBRE;
        $apellidos = $nombre_apellidos_tutor[0]->APELLIDOS;
        $mis_alumnos = $profesor1->misAlumnos2($id_curso_tutor);


        Session::put('nombre_tutor', $nombre);
        Session::put('apellidos_tutor', $apellidos);
        Session::put('nombre_grupo', $nombre_curso_tutor);

        $datos = [
            'mis_alumnos' => $mis_alumnos
        ];

        return view('FCT/memoriafinal', $datos);
    }

    /**
     * @return string
     * Sin usar
     */
    public function generar_excel()
    {
        return route('/excel');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra el resumen de las encuestas de los alumnos
     */
    public function resumenalumnos()
    {
        $alumno1 = new alumno();
        $encuesta1 = new encuesta();
        $preguntas = $encuesta1->obtenerPreguntasModeloAlumno();
        $preguntas_v = array();
        $medias_encuestas = array();
        $medias_preguntas = array();


        foreach ($preguntas as $preg) {
            $preguntas_v[] = $preg->IDMPREGUNTA;
        }

        $encuestas = $alumno1->obtenerEncuestas(Session::get('USUARIO')->getEmail());
        $i = 0;
        foreach ($encuestas as $enc) {
            $medias_encuestas[$i] = $encuesta1->mediasOpciones($enc->IDENCUESTA);
            $i++;
        }
        /*for ($e = 0; $e < count($encuestas); $e++) {
            $medias_preguntas[$i] = $encuesta1->mediasOpciones2($preguntas_v[$i]);
        }*/


        $datos = [
            'preguntas' => $preguntas_v,
            'encuestas' => $encuestas,
            'medias_encuestas' => $medias_encuestas
        ];

        return view('FCT/resumenalumnos', $datos);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra el resumen de las encuestas de las empresas
     */
    public function resumenempresas()
    {
        $empresa1 = new empresa();
        $encuesta1 = new encuesta();
        $preguntas = $encuesta1->obtenerPreguntasModeloEmpresa();
        $preguntas_v = array();

        foreach ($preguntas as $preg) {
            $preguntas_v[] = $preg->IDMPREGUNTA;
        }

        $encuestas = $empresa1->obtenerEncuestas(Session::get('USUARIO')->getEmail());

        $datos = [
            'preguntas' => $preguntas_v,
            'encuestas' => $encuestas
        ];

        return view('FCT/resumenempresas', $datos);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra todas las empresas disponibles en la bbdd.
     */
    public function solencuestas()
    {
        $empresa1 = new empresa();

        $todas_empresas = $empresa1->todasEmpresas();
        $datos = [
            'empresas' => $todas_empresas
        ];
        return view('FCT/solencuestas', $datos);
    }

    /**
     * @param Request $req
     * No se usa ya.
     */
    public function enviaremail(Request $req)
    {
        $empresa1 = new empresa();
        $cif = $req->CIF;
        $email_empresa = $empresa1->obtenerEmail($cif)[0]->EMAIL;
        /*
        $datos = [
            'usuario' => $email_empresa,
            'pass' => $pass
        ];
        */
        dd("FUNCIONALIDAD ABANDONADA");
        Mail::send('emails.recuperarpass', null, function ($message) use ($email_empresa) {
            $message->to($email_empresa)->subject('Introducir nueva contraseña');
        });


    }

}
