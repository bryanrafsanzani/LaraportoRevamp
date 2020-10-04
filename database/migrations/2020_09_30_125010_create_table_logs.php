<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('ip');
            $table->string('page');
            $table->enum('method', ['get', 'post', 'put', 'delete'])->default('get');
            $table->string('route_name')->nullable();
            $table->text('data')->nullable();
            $table->timestamp('access_date');
            $table->tinyInteger('trash')->default(0)->comment('0 => not deleted, 1 => soft delete');
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
        Schema::dropIfExists('logs');
    }
}
