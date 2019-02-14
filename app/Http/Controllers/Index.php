<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Index extends Controller
{
    public function Index(Request $request){
        return view('index');
    }

    public function initLoginData(Request $request){
        $data = [];
        $data['name'] = session('name');
        $data['id'] = session('id');
        return $data;
    }
}
