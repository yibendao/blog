<?php

use Illuminate\Database\Seeder;

class ArticleCategoryTableSeeder extends Seeder
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
                'name'=>'这是分类'.$i,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ];
        }
        DB::table('article_categories')->insert($data);
    }
}
