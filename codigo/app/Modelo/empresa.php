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
                'DNI REPRESENTANTE' => $dnirep, 'CONVENIO' => $convenio, 'ALIAS' => $alias,
                'POBLACION' => $poblacion, 'FAX' => $fax, 'OBSERVACIONES' => $observaciones,
                'FECHA DE CONVENIO' => $fechaconv_vec, 'DIRECCION' => $direccion, 'PROVINCIA' => $provincia,
                'CONVENIO REPRESENTANTE' => $convrep, 'TIPO' => $tipoempresa, 'FAVORITA' => $fav
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
        $consulta = DB::table('empresas')
            ->select('EMAIL', 'CIF', 'POBLACION', 'PROVINCIA', 'TELEFONO', 'NOMBRE', 'ALIAS', 'FAVORITA')
            ->get();
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
            ['EMAIL' => $usuario, 'PASS' => $password, 'NOMBRE' => $nombre]
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

}