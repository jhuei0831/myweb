<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->string('app_name')->comment('網站名稱');
            $table->string('font_family')->comment('字體');
            $table->string('font_size')->comment('字體大小');
            $table->string('font_weight')->comment('字體粗細');
            $table->string('background')->comment('背景');
            $table->string('background_color')->comment('背景顏色');
            $table->string('navbar_bcolor')->comment('導覽列背景顏色');
            $table->string('navbar_wcolor')->comment('導覽列字體顏色');
            $table->string('navbar_size')->comment('導覽列字體大小');
            $table->boolean('is_open')->default(true)->comment('網站是否開放');
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
        Schema::dropIfExists('configs');
    }
}
