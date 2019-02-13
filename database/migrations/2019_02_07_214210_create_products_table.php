<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('company_id');

            $table->string('name',30)->default('请设置商品名称');
            $table->string('avatar', 100)->default('default_avatar.jpg');
            $table->float('price', 10, 2);
            $table->string('unit',10);
            $table->text('memo')->nullable();

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companys')->onDelete('cascade')->onUpdate('cascade');
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
