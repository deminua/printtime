<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('imgs', function (Blueprint $table) {
            $table->increments('id');
           # $table->integer('imgable_id');
            #$table->string('imgable_type');
            $table->morphs('imgable');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('filename');
            $table->string('filemime');
            $table->integer('filesize');
            $table->boolean('status');
            $table->boolean('visibility');
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
        Schema::drop('imgs');
    }
}
