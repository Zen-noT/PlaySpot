<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            
        $table->increments('id');
        $table->unsignedInteger('shop_id');
        $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        $table->unsignedInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->tinyInteger('evaluation');
        $table->string('comment', 100);
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
        Schema::dropIfExists('evaluations');
    }
}
