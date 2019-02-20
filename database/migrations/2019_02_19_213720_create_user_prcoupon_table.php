<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPrcouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prcoupon', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('isused')->default(false);

			$table->integer('user_id')->unsigned();
			$table->integer('prcoupon_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('prcoupon_id')->references('id')->on('prcoupons')->onDelete('cascade');

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
        Schema::dropIfExists('user_prcoupon');
    }
}
