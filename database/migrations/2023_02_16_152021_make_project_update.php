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
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('c°', 4, 2)->nullable();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('kh', 4, 2)->nullable();
            $table->decimal('gh', 4, 2)->nullable();
            $table->decimal('no2', 4, 2)->nullable();
            $table->decimal('no3', 4, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
