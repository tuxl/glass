<?php

namespace App\Http\Controllers;

use App\ProductionList;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function listProduction(Request $request){
        $page = $request->query('page', 1);
        if ($page < 1) {
            $page = 1;
        }
        $pagesize = $request->query('pagesize');
        if ($pagesize == null) {
            $pagesize = 20;
        }
        $name = $request->query('name', null);

        $query = new ProductionList();
        $count = $query->count();

        if ($name){
            $query->where('originname', 'like', "%$name%");
        }

        $data = $query->orderBy('id', 'desc')->offset(($page - 1) * $pagesize)->limit($pagesize)->get();

        return [
            'count' => $count,
            'data' => $data,
        ];
    }
}
