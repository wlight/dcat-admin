<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('标题');
            $table->integer('driector')->comment('作者');
            $table->string('describe')->default('')->comment('描述');
            $table->tinyInteger('rate')->comment('排行');
            $table->tinyInteger('released')->comment('是否上映');
            $table->timestamp('release_at')->default('0000-00-00-00 00:00:00')->comment('发表时间');
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
        Schema::dropIfExists('movies');
    }
}
