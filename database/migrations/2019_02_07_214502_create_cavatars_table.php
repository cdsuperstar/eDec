<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCavatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cavatars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');

            $table->string('avatar', 100);
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
        Schema::dropIfExists('cavatars');
    }
}
