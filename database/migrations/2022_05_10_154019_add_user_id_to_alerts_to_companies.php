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
        Schema::table('alerts_to_companies', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("user_id")->nullable();
            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alerts_to_companies', function (Blueprint $table) {
            //
        });
    }
};
