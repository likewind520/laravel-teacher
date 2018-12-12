<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            //windows中的引擎设置,不然做约束不好使
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->default('')->comment('栏目名称');
            $table->unsignedInteger('pid')->default(0)->comment('父级id');
            $table->timestamps();
        },'栏目管理表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
