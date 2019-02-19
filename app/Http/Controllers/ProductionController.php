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

    /*
     * 添加
     * */
    public function addProduction(Request $request){
        $name = $request->input('name', '');
        $auther = $request->input('auther', '');
        $w = $request->input('w', '');
        $h = $request->input('h', '');
        $row = new ProductionList();
        $row->title = $name;
        $row->auther = $auther;
        $row->w = $w;
        $row->h = $h;
        $row->save();
    }

    public function editProduction(Request $request, $id){
        $row = ProductionList::where('id', $id)->first();
        $name = $request->input('name', '');
        $auther = $request->input('auther', '');
        $w = $request->input('w', '');
        $h = $request->input('h', '');
        $row->title = $name;
        $row->auther = $auther;
        $row->w = $w;
        $row->h = $h;
        $row->save();
    }

    /*
     * 详情
     * */
    public function productionDetail(Request $request, $id){
        $data = ProductionList::where('id', $id)->first();
        return $data;
    }

    /*
     * 删除图片
     * */
    public function deleteProduction(Request $request, $id){
        $data = ProductionList::where('id', $id)->first();
        if ($data){
            $data->delete();
        }
        return;
    }


    /*
     * 图片上传
     *
     * */
    public function picUpload(Request $request, $id){
        $data = ProductionList::where('id', $id)->first();
        if (!$data){
            return;
        }
        $pic = $request->file('pic',null);
        $type = $request->input('type', 'thumb');
        if (!$pic){
            return response('no pic upload!', 530);
        }
        $file = $pic->store('/picupload');
        if ($type == 'thumb') {
            $data->thumb_path = $file;
        } else {
            $data->mainpic = $file;
        }
        $data->save();
        return;

    }
}
