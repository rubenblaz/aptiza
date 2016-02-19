<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;

class Usuarios extends Controller {

    public function store() {

        if (Session::has('USUARIO')) {
            return view('inicio');
        } else {
            return view('login');
        }
    }

    public function errorlogin() {
        return view('login', ['error' => true]);
    }

    public function inicio() {
        return view('inicio');
    }

    public function logout() {

        Session::pull('USUARIO');

        return view('login');
    }
}
