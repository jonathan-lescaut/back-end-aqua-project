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
        Schema::create('livings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_living');
            $table->longText('description_living');
            $table->decimal('price_living', 12, 2);
            $table->timestamps();
            $table->foreign('id')
            ->references('id')
            ->on('categorie_livings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livings');
    }
};
