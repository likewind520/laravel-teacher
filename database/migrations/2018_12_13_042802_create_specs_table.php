<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string ('spec')->default ('')->comment ('商品规格');
            $table->integer ('total')->default (0)->comment ('库存');
            $table->unsignedInteger  ('good_id')->index ()->default (0)->comment ('栏目 id');
            $table->foreign('good_id')
                ->references('id')->on('goods')
                ->onDelete('cascade');
            $table->timestamps();
        },'布局右边商品规格表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specs');
    }
}
