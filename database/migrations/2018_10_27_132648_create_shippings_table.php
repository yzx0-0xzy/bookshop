<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(null);
            $table->string('receiver_name')->nullable()->default(null)->commment('收货人姓名');
            $table->string('receiver_phone')->nullable()->default(null)->commment('收货人固定电话');
            $table->string('receiver_mobile')->nullable()->default(null)->commment('收货人移动电话');
            $table->string('receiver_province')->nullable()->default(null)->commment('省份');
            $table->string('receiver_city')->nullable()->default(null)->commment('城市');
            $table->string('receiver_district')->nullable()->default(null)->commment('区');
            $table->string('receiver_address')->nullable()->default(null)->commment('详细地址');
            $table->string('receiver_zip')->nullable()->default(null)->commment('邮编');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
