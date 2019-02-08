<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('company_id')->references('id')->on('companys')->onDelete('cascade')->onUpdate('cascade');
            $table->string('avatar1', 100);
            $table->string('avatar2', 100);
            $table->string('avatar3', 100);
            $table->string('avatar4', 100);
            $table->string('avatar5', 100);
            $table->string('avatar6', 100);
            $table->string('avatar7', 100);
            $table->string('avatar8', 100);
            $table->string('avatar9', 100);

            $table->float('price', 10, 2);
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
        Schema::dropIfExists('packages');
    }
}
