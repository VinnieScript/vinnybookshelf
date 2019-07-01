<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('samsung');
            $table->string('iphone');
            $table->string('itel');
            $table->string('nokia');
            $table->string('techno');
            $table->string('month');
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
        
        Schema::dropIfExists('data');
    }
}
