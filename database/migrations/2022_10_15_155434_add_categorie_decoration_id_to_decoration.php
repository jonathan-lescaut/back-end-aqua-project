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
        Schema::table('decorations', function (Blueprint $table) {
            $table->bigInteger('categorie_decoration_id')->unsigned();
            $table->foreign('categorie_decoration_id')
                ->references('id')
                ->on('categorie_decoration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('decorations', function (Blueprint $table) {
            $table->dropColumn('categorie_decoration_id');
        });
    }
};
