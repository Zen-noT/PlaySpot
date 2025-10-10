<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id'); 
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->tinyInteger('day_of_week'); 
            $table->tinyInteger('type'); 
            $table->decimal('prise', 8, 2);
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
        Schema::dropIfExists('prises');
    }
}
