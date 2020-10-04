<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDynamicForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('data_type', ['integer', 'double', 'text','long_text', 'boolean', 'date', '0'])->default(0);
            $table->integer('parent')->default(0);
            $table->tinyInteger('required')->default(1)->comment('0 => can nullable, 1 => must required');
            $table->tinyInteger('status')->default(1)->comment('0 => Disable, 1 => Enable');
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
        Schema::dropIfExists('dynamic_forms');
    }
}