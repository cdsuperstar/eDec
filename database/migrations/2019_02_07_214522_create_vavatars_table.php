<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVavatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vavatars', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('vavatar_id')->references('id')->on('avatars')->onDelete('cascade')->onUpdate('cascade');
            $table->string('avatar', 100);
            $table->text('memo')->nullable();

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
        Schema::dropIfExists('vavatars');
    }
}
