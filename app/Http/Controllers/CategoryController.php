<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listCategory(Request $request){
        $page = $request->query('page', 1);
        if ($page < 1) {
            $page = 1;
        }
        $pagesize = $request->query('pagesize');
        if ($pagesize == null) {
            $pagesize = 20;
        }
        $name = $request->query('name', null);

        $query = new Category();
        $count = $query->count();

        if ($name){
            $query =  $query->where('name', 'like', "%$name%");
        }

        $data = $query->orderBy('id', 'desc')->offset(($page - 1) * $pagesize)->limit($pagesize)->get();

        return [
            'count' => $count,
            'data' => $data,
        ];
    }

    /*
     * 添加
     * */
    public function addCategory(Request $request){
        $name = $request->input('name', '');

        $row = new Category();
        $row->name = $name;
        $row->save();
    }

    public function editCategory(Request $request, $id){
        $row = Category::where('id', $id)->first();
        $name = $request->input('name', '');
        $row->name = $name;
        $row->save();
    }

    /*
     * 详情
     * */
    public function productionDetail(Request $request, $id){
        $data = Category::where('id', $id)->first();
        return $data;
    }

    /*
     * 删除
     * */
    public function deleteCategory(Request $request, $id){
        $data = Category::where('id', $id)->first();
        if ($data){
            $data->delete();
        }
        return;
    }


    public function listALlCate(Request $request){
        return Category::all();
    }

}
