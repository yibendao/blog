<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50);
            $table->string('author',20);
            $table->integer('pic_id')->nullable();
            $table->integer('cate_id')->default(0);
            $table->enum('status',['draft','publish','delete','suspend'])->default('draft');
            $table->enum('recom',['ON','OFF'])->default('OFF');
            $table->enum('top',['ON','OFF'])->default('OFF');
            $table->string('src')->nullable();
            $table->string('desc')->nullable();
            $table->text('content')->nullable();
            $table->integer('user_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
