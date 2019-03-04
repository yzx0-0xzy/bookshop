<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->integer('publisher_id')->nullable()->default(null)->comment('出版社ID');
            $table->integer('subcategory_id')->nullable()->default(null)->commment('子目录ID');
            $table->string('writer')->nullable()->default(null)->commment('作者');
            $table->decimal('price',20,2)->nullable()->default(null)->commment('售价');
            $table->string('book_image')->nullable()->default(null)->commment('图片地址');  
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
        Schema::dropIfExists('books');
    }
}
