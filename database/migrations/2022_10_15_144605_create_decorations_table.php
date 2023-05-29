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
        Schema::create('decorations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_decoration');
            $table->longText('description_decoration');
            $table->decimal('price_decoration', 12, 2);
            $table->string('picture_decoration');
            $table->timestamps();
            $table->foreign('id')
                ->references('id')
                ->on('categorie_decorations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decorations');
    }
};
