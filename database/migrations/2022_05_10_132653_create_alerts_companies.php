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
        Schema::create('alerts_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("alerts_id")->nullable();
            $table->unsignedBigInteger("companies_id")->nullable();
            $table->timestamps();
            $table
                ->foreign("alerts_id")
                ->references("id")
                ->on("alerts")
                ->onDelete("Cascade")
                ->onUpdate("Cascade");
            $table
                ->foreign("companies_id")
                ->references("id")
                ->on("companies")
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
        Schema::dropIfExists('alerts_companies');
    }
};
