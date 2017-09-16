<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resources extends Model
{
    protected $appends =['imgsrv'];
    public $fillable =['name','type','size','file','status'];

    public function getImgsrvAttribute()
    {
        return $this->getImgsrv();
    }

    public function getImgsrv()
    {
        if($this->disk == "qiniu") {
            return Storage::disk('qiniu')->imagePreviewUrl($this->file,'imageView2/0/w/100/h/200');
        }
        return asset('imgsys/' . $this->file) ;
    }
}
