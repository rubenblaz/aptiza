<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminUsuarios extends Controller
{
    public function inicio(){
        return view('admin/admininicio');
    }
}
