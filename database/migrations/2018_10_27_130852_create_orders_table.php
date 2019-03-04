<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('order_no')->nullable()->default(null)->commment('订单号');
            $table->integer('seller_id')->nullable()->default(null)->commment('卖家id');
            $table->integer('buyer_id')->nullable()->default(null)->commment('买家id');
            $table->integer('transaction')->nullable()->default(null)->commment('交易方式：0-快递，10-面交');
            $table->decimal('payment',20,2)->nullable()->default(null)->commment('支付金额，元，保留两位小数');
            $table->integer('payment_type')->nullable()->default(null)->commment('支付类型，1-在线支付');
            $table->integer('postage')->nullable()->default(null)->commment('运费-元');
            // status=30 未发货
            $table->integer('status')->nullable()->default(null)->commment('订单状态：0-已取消，10-未付款，20-已付款，40-已发货，50-交易关闭');
            $table->dateTime('payment_time')->nullable()->default(null)->commment('支付时间');
            $table->dateTime('send_time')->nullable()->default(null)->commment('发货时间');
            $table->dateTime('end_time')->nullable()->default(null)->commment('交易完成时间');
            $table->dateTime('close_time')->nullable()->default(null)->commment('交易关闭时间');
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
        Schema::dropIfExists('orders');
    }
}
