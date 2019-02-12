<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');

            $table->string('name',50)->unique();
            $table->string('ctype',30);
            $table->string('address',200)->nullable();

            $table->string('owner',50);
            $table->string('tel',15)->nullable();
            $table->string('phone',15)->nullable();
            //介绍
            $table->text('memo')->nullable();
            //工艺流程介绍
            $table->text('aomemo')->nullable();

            $table->string('stat',10)->default('申请中。。。');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companys');
    }
}
