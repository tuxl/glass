<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Index extends Controller
{
    public function adminIndex(Request $request){
        return view('index');
    }

    public function initLoginData(Request $request){
        $data = [];
        $data['name'] = session('name');
        $data['id'] = session('id');
        return $data;
    }

    public function index(Request $request){
        $catid = $request->query('cid', null);
        $query = new ProductionList();
        if ($catid){
            $query = $query->where('catid', $catid);
        }
        $picList = $query->get();
        $catlist = Category::all();
        return view('main',[
            'data' => $picList,
            'catlist' => $catlist,
        ]);
    }
}
