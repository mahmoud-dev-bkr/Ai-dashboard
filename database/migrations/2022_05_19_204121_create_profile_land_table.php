<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_land', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('span');
            $table->string('title');
            $table->string('download')->default("#");
            $table->string('learn_more')->default("#");
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
        Schema::dropIfExists('profile_land');
    }
};
