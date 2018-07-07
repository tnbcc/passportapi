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
            $table->string('phone')->unique();
            $table->string('password');
            $table->tinyInteger('status')->index()->default('1')->comment('用户状态');
            $table->string('alipay')->nullable()->comment('支付宝账号');
            $table->string('aliname')->nullable()->comment('支付宝实名');
            $table->string('remark')->nullable()->comment('备注');
            $table->string('true_ip')->nullable()->comment('获得用户真实IP');
            $table->decimal('total', 8, 2)->nullable()->default(0);
            $table->integer('notification_count')->unsigned()->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
