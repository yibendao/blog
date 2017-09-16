<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function pageList($request,$model)
    {
        $page = $request->input('page',1);
        $pageSize = $request->input('limit',10);
        $sort =$request->input('sort','created_at');
        $order = $request->input('order','asc');
        $filter = $request->input('q',null);
        if($filter && $model->searches) {
            foreach ($model->searches as $search) {
                $model->whereRaw($search .' like "%'.$filter.'%"');
            }
        }

        $total = $model->count();
        $items = $model->orderBy($sort,$order)->skip(($page-1)*$pageSize)->take($pageSize)->get();

        return array('total'=>$total,'items'=>$items,'page'=>$page,'limit'>$pageSize,'sort'=>$sort,'order'=>$order,'q'=>$filter);
    }

    protected function beforeSave($data)
    {
        return true;
    }
    protected function afterSave($data)
    {
        return true;
    }
    protected function beforeShow($data)
    {
        return true;
    }
    protected function beforeDestroy($data)
    {
        return true;
    }

    protected function response($success,$data,$code=200)
    {
        $success = $success ? 'true' : 'false';
        $data =['success'=>$success] + $data;
        return response()->json($data,$code);
    }

    protected function responseError($message,$code)
    {
        return $this->response(false,['error'=>[
            'msg'=>$message,
            'code'=>$code
        ]]);
    }

    protected function responseAjax($data,$count,$msg="",$code=0)
    {
        return response()->json(['code'=>$code,'msg'=>$msg,'count'=>$count,'data'=>$data]);
    }
    protected function responseNotFound($message='not found',$code=404)
    {
        return $this->responseError($message,$code);
    }
}
