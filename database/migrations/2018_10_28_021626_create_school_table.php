<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')->default('')->comment('学校名');
            $table->string('province', 128)->default('')->comment('省份');
            $table->string('city', 128)->default('')->comment('城市');
            $table->integer('counting')->default('0')->comment('学校用户人数');
            $table->integer('type')->default('0')->comment('学校类型：0-理工科、1-综合型大学');
            $table->integer('trade')->default('0')->comment('交易数量');
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
        Schema::dropIfExists('schools');
    }
}
