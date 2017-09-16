<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = ['title','author','pic_id','status','src','desc','content','top','recom','user_id','created_at','updated_at'];

    public $searches = ['id','title','author'];

    public function pic()
    {
        return $this->belongsTo('App\Model\Resources','pic_id','id');
    }
}
