<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->text('detail')->comment('內容');
            $table->integer('price')->unsigned()->comment('價錢');
            $table->string('unit')->comment('單位');
            $table->integer('discount')->unsigned()->nullable()->comment('折扣');
            $table->integer('amount')->unsigned()->comment('剩餘數量');
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
        Schema::dropIfExists('products');
    }
}
