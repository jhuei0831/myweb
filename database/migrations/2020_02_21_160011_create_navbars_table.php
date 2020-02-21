<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavbarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id')->comment('頁面id');
            $table->foreign('page_id')->references('id')->on('pages');
            $table->string('name')->comment('導覽名稱');
            $table->string('link')->comment('對外連結');
            $table->integer('type')->comment('類型');
            $table->integer('sort')->comment('排序');
            $table->boolean('is_open')->default(true)->comment('是否開放');
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
        Schema::dropIfExists('navbars');
    }
}
