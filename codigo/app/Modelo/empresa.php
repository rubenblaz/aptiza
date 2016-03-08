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

    public function empresasFavoritas()
    {
        $empresas_fav = DB::table('empresas')
            ->select('CIF', 'NOMBRE')
            ->where('FAVORITA', '=', 'SI')
            ->get();

        return $empresas_fav;
    }

    public function usuarioEmpresa($seleccion_empresa)
    {
        $usuario_empresa = DB::table('empresas')
            ->select('EMAIL')
            ->where('CIF', $seleccion_empresa)
            ->get();

        return $usuario_empresa;
    }

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

    public function borrarFavorita($cif)
    {
        DB::table('empresas')
            ->where('CIF', $cif)
            ->update(['FAVORITA' => 'NO']);
    }

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

    public function insertarUsuario($usuario, $password, $nombre)
    {
        DB::table('usuarios')->insert(
            ['EMAIL' => $usuario, 'PASS' => Hash::make($password), 'NOMBRE' => $nombre]
        );
        DB::table('usuariosrol')->insert(
            ['EMAIL' => $usuario, 'IDROL' => 4]
        );
    }

    public function obtenerNombreEmpresa($email)
    {
        $nombre_empresa = DB::table('empresas')
            ->join('alumnos', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
            ->select('empresas.NOMBRE')
            ->where('alumnos.EMAIL', $email)
            ->get();
        return $nombre_empresa;
    }

    public function obtenerNombre($email)
    {
        $consulta = DB::table('empresas')
            ->select('NOMBRE')
            ->where('EMAIL', $email)
            ->get();
        return $consulta;
    }

    public function obtenerCursoAlumnos($email)
    {
        $consulta = DB::table('alumnos')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
            ->join('cursos', 'cursos.IDCICLO', '=', 'alumnos.CURSO')
            ->select('cursos.CICLO')
            ->where('alumnos.IDEMPRESA', $email)
            ->get();
        return $consulta;
    }

    public function obtenerEmail($cif)
    {
        $consulta = DB::table('empresas')
            ->select('EMAIL')
            ->where('CIF', $cif)
            ->get();
        return $consulta;
    }

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
            ->orderBy('encuesta.IDENCUESTA', 'elige.IDPREGUNTA')
            ->get();

        return $consulta2;
    }

    public function obtenerTodosDatos($cif)
    {
        $consulta = DB::table('empresas')
            ->select('EMAIL', 'CIF', 'NOMBRE', 'CP', 'TELEFONO', 'DNI_REPRESENTANTE', 'CONVENIO', 'ALIAS', 'POBLACION', 'FAX', 'OBSERVACIONES',
                'FECHA_DE_CONVENIO', 'DIRECCION', 'PROVINCIA', 'CONVENIO_REPRESENTANTE', 'TIPO', 'FAVORITA')
            ->where('CIF', $cif)
            ->get();
        return $consulta;
    }

    public function actualizarUsuario($usuario_empresa, $usuario_original)
    {
        DB::table('usuarios')
            ->where('EMAIL', $usuario_original)
            ->update(['EMAIL' => $usuario_empresa]);
        DB::table('usuariosrol')
            ->where('EMAIL', $usuario_original)
            ->update(['EMAIL' => $usuario_empresa]);

    }

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