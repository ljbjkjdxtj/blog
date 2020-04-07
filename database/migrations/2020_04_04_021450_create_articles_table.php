<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('author',20)->comment('作者');
            $table->string('title')->comment('题目');
            $table->enum('type',['原创','转载'])->default('原创');
            $table->string('content')->comment('内容');
            $table->string('picture')->comment('描述图片');
            $table->bigInteger('block_id')->unsigned();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->integer('view_count')->default(0);
            $table->enum('isDelete',['0','1','2'])->default('0')->comment('0没删,1删了,2隐藏');

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
