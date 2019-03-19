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
        $picList = $query->limit(24)->orderby('id', 'asc')->get();
        $lastid = 0;
        if (count($picList)>0){
            $lastid = $picList[count($picList)-1]->id;
        }
        $catlist = Category::all();
        return view('main',[
            'data' => $picList,
            'catlist' => $catlist,
            'lastid' => $lastid,
            'catid' => $catid,
        ]);
    }

    public function pageData(Request $request){
        $catid = $request->query('catid', null);
        $lastid = $request->query('lastid', 0);
        $query = new ProductionList();
        if ($catid){
            $query = $query->where('catid', $catid);
        }
        $picList = $query->where('id', '>', $lastid)->limit(24)->orderby('id', 'asc')->get();
        $lastid = 0;
        if (count($picList)>0){
            $lastid = $picList[count($picList)-1]->id;
        }
        return [
            'data' => $picList,
            'lastid' => $lastid
        ];
    }
}
