<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=1;$i<2;$i++) {
            $data[]=[
                'name'=>'1.jpg',
                'type'=>'image/jpeg',
                'size'=>531688,
                'file'=>'imgsrv/20170917/06c94b4fb49629aaad62e309d9853ce2.jpeg',
                'status'=>'normal',
                'disk'=>'qiniu',
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ];
        }
        DB::table('resources')->insert($data);
    }
}
