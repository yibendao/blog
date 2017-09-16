<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=1;$i<30;$i++) {
            $data[]=[
                'title'=>'这是文章'.$i,
                'author'=>'张山',
                'pic_id'=>1,
                'status'=>'publish',
                'recom'=>'OFF',
                'top'=>'OFF',
                'src'=>'原创',
                'desc'=>'这是描述',
                'content'=>'这是内容'.$i,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ];
        }
        DB::table('articles')->insert($data);
    }
}
