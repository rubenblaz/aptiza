<?php

namespace App\Modelo;

use DB;

/**
 * Description of Grupo
 *
 * @author Ernesto
 */
class Grupo {

    private $nombre;
    private $curso;
    private $tutor;

    function __construct($nombre, $curso, $tutor) {
        $this->nombre = $nombre;
        $this->curso = $curso;
        $this->tutor = $tutor;
    }

    static function listByProfesor($cod_profesor) {
        $result = DB::table('profesor_asignatura')
                ->select('GRUPO')
                ->where('PROFESOR', $cod_profesor)
                ->get();
        foreach ($result as $var) {
            $grupos[$var->GRUPO] = $var->GRUPO;
        }
        return $grupos;
    }

    static function getGrupoTutor($profesor) {
        $r = DB::table('grupo')
                ->where('TUTOR', '=', $profesor)
                ->get();

        return new Grupo($r[0]->NOMBRE, $r[0]->CURSO, $r[0]->TUTOR);
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCurso() {
        return $this->curso;
    }

    function getTutor() {
        return $this->tutor;
    }

}
