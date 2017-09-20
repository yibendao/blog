<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Articles extends Model
{
    protected $fillable = ['title','author','pic_id','status','src','desc','content','top','recom','user_id','cate_id','created_at','updated_at'];
    protected $appends = ['formatStatus'];
    protected $errors;

    public $searches = ['id','title','author'];

    public function getFormatStatusAttribute()
    {
        $text = ['draft'=>'草稿','publish'=>'已发布','suspend'=>'停用','delete'=>'已删除'];
        return isset($text[$this->status]) ? $text[$this->status] : 'N/A';
    }
    public function beforeSave()
    {
        return true;
    }
    public function getImgsrvAttribute()
    {
        return $this->getImgsrv();
    }
    public function getImgsrv()
    {
        return $this->pic ? $this->pic->imgsrv : '';
    }

    public function pic()
    {
        return $this->belongsTo('App\Model\Resources','pic_id','id');
    }

    public function getCategoriesAttribute()
    {
        return DB::table('article_categories')->select('id','name')->get();
    }

    public function category()
    {
        return $this->belongsTo('App\Model\ArticleCategories','cate_id','id');
    }
}
