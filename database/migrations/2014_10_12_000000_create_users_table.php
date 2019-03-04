<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('balance')->default('0')->comment('余额，单位分');
            $table->integer('school_id')->default('0')->comment('学校ID');
            $table->integer('score')->default('0')->comment('用户评分');
            $table->tinyInteger('gender')->default('1')->comment('性别：0-女、1-男');
            $table->string('mobile', 20)->default('')->comment('手机');
            $table->string('contact_backup', 128)->default('')->comment('备用联系方式');
            $table->tinyInteger('is_admin')->default('0')->comment('是否管理员：0-否、1-是');
            $table->tinyInteger('status')->default('0')->comment('账号状态，-1禁用，0初始状态，1已验证邮箱，2已验证手机号');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
