<?php

namespace App\Http\Controllers;

use App\Model\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        if($file->isValid()) {
            $tempPath = $file->path();
            $ext = $file->extension();
            $newFileName = md5($tempPath . rand(100,999) . uniqid() . time()) .'.' . $ext;
            $newPath = 'imgsrv/' . date('Ymd') . '/' . $newFileName;

            //存储
            Storage::disk('qiniu')->put($newPath,file_get_contents($tempPath));

            //保存数据库
            $resource = new Resources();
            $resource->name = $file->getClientOriginalName();
            $resource->type = $file->getClientMimeType();
            $resource->size = $file->getClientSize();
            $resource->file = $newPath;
            $resource->disk = 'qiniu';
            $resource->status = 'normal';
            $resource->save();

            return response()->json(['success'=>true,'data'=>$resource]);
        }
        return response()->json(['success'=>false,'msg'=>'上传失败']);
    }
    public function getRealImagePath(Request $request)
    {
        $realPath = str_replace('/imgsys','',$request->getRequestUri());
        $path = storage_path() .'/app'. $realPath;

        if(!file_exists($path)){
            //报404错误
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            exit;
        }
        //输出图片
        header('Content-type: image/jpg');
        echo file_get_contents($path);
        exit;

    }
    public function getImg()
    {
        echo '<img src="'.asset('imgsys/20170911/ef7548447d7ee819cb345e0df40614da.jpeg').'">';
    }
}
