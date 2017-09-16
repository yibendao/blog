<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected $model;
    protected $error;

    public function __construct(Request $request)
    {
        if($request->input('_model')) {
            $model = "App\Model\\" . $request->input('_model');
            $this->model = new $model();
        } else {
            return $this->responseNotFound();
        }
    }

    protected function query()
    {
        return $this->model;
    }

    protected function model($id = false)
    {
        return $id ? $this->model->find($id) : $this->model;
    }

    public function index(Request $request)
    {
        $page = $request->input('page',1);
        $pageSize = $request->input('limit',10);
        $sort = $request->input('sort','created_at');
        $order = $request->input('order','asc');
        $filter = $request->input('q',null);
        $query = $this->query();
        if($filter && $this->model->searches){
            $sql = '';
            foreach ($this->model->searches as $k=>$search) {
                $raw = $search .' like "%'.$filter.'%" ';
                if($k!==0) $raw = ' or ' . $raw;
                $sql .= $raw;
            }
            $query = $query->whereRaw($sql);
        }
        $total = $query->count();
        $items = $query->orderBy($sort,$order)->skip(($page-1)*$pageSize)->take($pageSize)->get();
        return $this->responseAjax($items,$total);
    }

    public function store(Request $request)
    {
        if($this->beforeSave($request->all())) {
            $model = $this->model()->fill($request->all());
            if(!$model->save()) {
                return $this->response(true,['item'=>$model]);
            } else {
                $this->error = $model->errors;
            }
        }

        return $this->responseError($this->error,201);
    }

    public function update(Request $request,$id)
    {
        if($this->beforeSave($request->all())) {
            $model = $this->model($id);
            $model = $model->fill($request->all());

            if($model->save()) {
                return $this->response(true,['item'=>$model]);
            } else {
                $this->error = $model->errors;
            }
        }

        return $this->responseError($this->error,201);
    }

    public function destroy(Request $request,$id)
    {
        $mode = $this->model($id);
        if($this->beforeDestroy($request->all())) {
            $mode->delete();
            return $this->response(true,['msg'=>'删除成功'],201);
        }
        return $this->response(false,['msg'=>'删除失败'],204);
    }
}
