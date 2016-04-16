<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 12/02/16
 * Time: 10:13
 */

namespace app\Modelo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;

class empresa
{

    /**
     * empresa constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $cif
     * @return bool
     * Comprueba si existe una empresa mediante el $cif
     */
    public function comprobarEmpresa($cif)
    {
        $cifempresa = DB::table('empresas')
            ->select('CIF')
            ->where('CIF', $cif)
            ->count();

        $existe = false;

        if ($cifempresa > 0) {
            $existe = true;
        }
        return $existe;
    }

    /**
     * @param $usuario
     * @param $cif
     * @param $nombre
     * @param $cp
     * @param $telefono
     * @param $dnirep
     * @param $convenio
     * @param $alias
     * @param $poblacion
     * @param $fax
     * @param $observaciones
     * @param $fechaconv_vec
     * @param $direccion
     * @param $provincia
     * @param $convrep
     * @param $tipoempresa
     * @param $fav
     * Inserta una nueva empresa en la bbdd.
     */
    public function insertarEmpresa($usuario, $cif, $nombre, $cp, $telefono, $dnirep, $convenio, $alias, $poblacion, $fax, $observaciones, $fechaconv_vec, $direccion, $provincia, $convrep, $tipoempresa, $fav)
    {
        DB::table('empresas')->insert(
            ['EMAIL' => $usuario, 'CIF' => $cif, 'NOMBRE' => $nombre, 'CP' => $cp, 'TELEFONO' => $telefono,
                'DNI_REPRESENTANTE' => $dnirep, 'CONVENIO' => $convenio, 'ALIAS' => $alias,
                'POBLACION' => $poblacion, 'FAX' => $fax, 'OBSERVACIONES' => $observaciones,
                'FECHA_DE_CONVENIO' => $fechaconv_vec, 'DIRECCION' => $direccion, 'PROVINCIA' => $provincia,
                'CONVENIO_REPRESENTANTE' => $convrep, 'TIPO' => $tipoempresa, 'FAVORITA' => $fav
            ]
        );
    }

    /**
     * @return mixed
     * Devuelve las empresas favoritas "SI".
     */
    public function empresasFavoritas()
    {
        $empresas_fav = DB::table('empresas')
            ->select('CIF', 'NOMBRE')
            ->where('FAVORITA', '=', 'SI')
            ->get();

        return $empresas_fav;
    }

    /**
     * @param $seleccion_empresa
     * @return mixed
     * Devuelve el email de la empresa pasada como parametro.
     */
    public function usuarioEmpresa($seleccion_empresa)
    {
        $usuario_empresa = DB::table('empresas')
            ->select('EMAIL')
            ->where('CIF', $seleccion_empresa)
            ->get();

        return $usuario_empresa;
    }

    /**
     * @return mixed
     * Devuelve todas las empresas paginadas de 10 en 10.
     */
    public function todasEmpresas()
    {
        /*
        $consulta = DB::table('empresas')
            ->select('EMAIL', 'CIF', 'POBLACION', 'PROVINCIA', 'TELEFONO', 'NOMBRE', 'ALIAS', 'FAVORITA')
            ->get();
        */
        $consulta = DB::table('empresas')
            ->select('EMAIL', 'CIF', 'POBLACION', 'PROVINCIA', 'TELEFONO', 'NOMBRE', 'ALIAS', 'FAVORITA')
            ->paginate(10);
        return $consulta;
    }

    /**
     * @param $cif
     * Elimina una empresa de favoritas.
     */
    public function borrarFavorita($cif)
    {
        DB::table('empresas')
            ->where('CIF', $cif)
            ->update(['FAVORITA' => 'NO']);
    }

    /**
     * @param $usuario
     * @return bool
     * Comprueba si existe el usuario pasado por parametro.
     */
    public function comprobarUsuario($usuario)
    {
        $existe = false;
        $consulta = DB::table('usuarios')
            ->select('EMAIL')
            ->where('EMAIL', $usuario)
            ->count();

        if ($consulta > 0) {
            $existe = true;
        }
        return $existe;
    }

    /**
     * @param $usuario
     * @param $password
     * @param $nombre
     * Inserta una empresa nueva como usuario capaz de loguerse en la aplicación web.
     */
    public function insertarUsuario($usuario, $password, $nombre)
    {
        DB::table('usuarios')->insert(
            ['EMAIL' => $usuario, 'PASS' => Hash::make($password), 'NOMBRE' => $nombre]
        );
        DB::table('usuariosrol')->insert(
            ['EMAIL' => $usuario, 'IDROL' => 4]
        );
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene el nombre de la empresa pasada como parametro referente a alumnos.
     */
    public function obtenerNombreEmpresa($email)
    {
        /**
        $nombre_empresa = DB::table('empresas')
            ->join('alumnos', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
            ->select('empresas.NOMBRE')
            ->where('alumnos.EMAIL', $email)
            ->get();**/
        $nombre_empresa = DB::table('alumno_empresa')
            ->join('alumno', 'alumno.COD', '=', 'alumno_empresa.IDALUMNO')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumno_empresa.IDEMPRESA')
            ->select('empresas.NOMBRE')
            ->where('alumno.EMAIL', $email)
            ->get();
        return $nombre_empresa;
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene el nombre de la empresa pasada como parametro.
     */
    public function obtenerNombre($email)
    {
        $consulta = DB::table('empresas')
            ->select('NOMBRE')
            ->where('EMAIL', $email)
            ->get();
        return $consulta;
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene el curso del alumno que coincida con la empresa pasada como parametro.
     */
    public function obtenerCursoAlumnos($email)
    {
        /*$consulta = DB::table('alumnos')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
            ->join('cursos', 'cursos.IDCICLO', '=', 'alumnos.CURSO')
            ->select('cursos.CICLO')
            ->where('alumnos.IDEMPRESA', $email)
            ->get();*/
        /** @var  $consulta
         * Adaptado a Aptiza
         **/

        $consulta = DB::table('alumno_empresa')
            ->join('matricula', 'alumno_empresa.IDALUMNO', '=', 'matricula.ALUMNO')
            ->select('matricula.GRUPO')
            ->where('alumno_empresa.IDEMPRESA', $email)
            ->get();

        return $consulta;
    }

    /**
     * @param $cif
     * @return mixed
     * Obtiene el email de la empresa que coincida con el CIF pasado como parametro.
     */
    public function obtenerEmail($cif)
    {
        $consulta = DB::table('empresas')
            ->select('EMAIL')
            ->where('CIF', $cif)
            ->get();
        return $consulta;
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene las encuestas realizadas de las empresas.
     */
    public function obtenerEncuestas($email)
    {
        $consulta1 = DB::table('profesores')
            ->select('CURSO')
            ->where('EMAIL', $email)
            ->get();
        $curso = $consulta1[0]->CURSO;
        $consulta2 = DB::table('encuesta')//ENCUESTAS
        ->join('elige', 'encuesta.IDENCUESTA', '=', 'elige.IDENCUESTA')
            ->join('profesores', 'profesores.CURSO', '=', 'encuesta.IDCICLO')
            ->select('encuesta.IDENCUESTA', 'elige.IDOPCION')
            ->where('profesores.CURSO', $curso)
            ->where('profesores.EMAIL', $email)
            ->where('encuesta.IDMODELO', 2)
            ->orderBy('encuesta.IDENCUESTA')
            ->get();

        return $consulta2;
    }

    /**
     * @param $cif
     * @return mixed
     * Obtiene todos los datos de una empresa que coincida con el CIF pasado como parametro.
     */
    public function obtenerTodosDatos($cif)
    {
        $consulta = DB::table('empresas')
            ->select('EMAIL', 'CIF', 'NOMBRE', 'CP', 'TELEFONO', 'DNI_REPRESENTANTE', 'CONVENIO', 'ALIAS', 'POBLACION', 'FAX', 'OBSERVACIONES',
                'FECHA_DE_CONVENIO', 'DIRECCION', 'PROVINCIA', 'CONVENIO_REPRESENTANTE', 'TIPO', 'FAVORITA')
            ->where('CIF', $cif)
            ->get();
        return $consulta;
    }

    /**
     * @param $usuario_empresa
     * @param $usuario_original
     * Actualiza los datos de usuario de una empresa ya creada con anterioridad.
     */
    public function actualizarUsuario($usuario_empresa, $usuario_original)
    {
        DB::table('usuarios')
            ->where('EMAIL', $usuario_original)
            ->update(['EMAIL' => $usuario_empresa]);
        DB::table('usuariosrol')
            ->where('EMAIL', $usuario_original)
            ->update(['EMAIL' => $usuario_empresa]);

    }

    /**
     * @param $usuario_empresa
     * @param $cif
     * @param $nombre
     * @param $cp
     * @param $telefono
     * @param $dnirep
     * @param $convenio
     * @param $alias
     * @param $poblacion
     * @param $fax
     * @param $observaciones
     * @param $fechaconv_vec
     * @param $direccion
     * @param $provincia
     * @param $convrep
     * @param $tipoempresa
     * @param $fav
     * @param $usuario_empresa_original
     * Actualiza los datos de la empresa ya existente a unos nuevos.
     */
    public function actualizarDatos($usuario_empresa, $cif, $nombre, $cp, $telefono, $dnirep, $convenio, $alias, $poblacion, $fax, $observaciones, $fechaconv_vec, $direccion, $provincia, $convrep, $tipoempresa, $fav, $usuario_empresa_original)
    {
        DB::table('empresas')
            ->where('EMAIL', $usuario_empresa_original)
            ->update(['EMAIL' => $usuario_empresa, 'CIF' => $cif, 'NOMBRE' => $nombre, 'CP' => $cp, 'TELEFONO' => $telefono,
                'DNI_REPRESENTANTE' => $dnirep, 'CONVENIO' => $convenio, 'ALIAS' => $alias,
                'POBLACION' => $poblacion, 'FAX' => $fax, 'OBSERVACIONES' => $observaciones,
                'FECHA_DE_CONVENIO' => $fechaconv_vec, 'DIRECCION' => $direccion, 'PROVINCIA' => $provincia,
                'CONVENIO_REPRESENTANTE' => $convrep, 'TIPO' => $tipoempresa, 'FAVORITA' => $fav]);
    }
}