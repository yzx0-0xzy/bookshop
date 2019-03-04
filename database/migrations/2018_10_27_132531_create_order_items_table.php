<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable()->default(null)->commment('');
            $table->integer('seller_id')->nullable()->default(null)->commment('');
            $table->integer('buyer_id')->nullable()->default(null)->commment('');
            $table->bigInteger('order_no')->nullable()->default(null)->commment('订单号');
            $table->integer('book_id')->nullable()->default(null)->commment('书籍id');
            $table->string('book_name')->nullable()->default(null)->commment('书籍名称');
            $table->string('book_image')->nullable()->default(null)->commment('图片地址');
            $table->decimal('book_price',20,2)->nullable()->default(null)->commment('支付价格');
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
