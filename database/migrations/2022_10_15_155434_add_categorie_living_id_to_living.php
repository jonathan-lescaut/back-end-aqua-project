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
        Schema::table('livings', function (Blueprint $table) {
            $table->bigInteger('categorie_living_id')->unsigned();
            $table->foreign('categorie_living_id')
                ->references('id')
                ->on('categorie_living');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('living', function (Blueprint $table) {
            $table->dropColumn('categorie_living_id');
        });
    }
};
