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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
			$table->string('heading');
			$table->string('slug')->unique();
			$table->unsignedInteger('stock');
			$table->unsignedInteger('price');
			$table->unsignedInteger('preparation_time')->nullable()->comment('Pre minute');
            $table->foreignId('menu_id');
			$table->text('history')->nullable();
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
};
