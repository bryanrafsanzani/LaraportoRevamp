<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('author')->nullable()->comment('user_id who upload file');
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->text('file_path')->nullable();
            $table->text('full_path')->nullable();
            $table->string('raw_name')->nullable();
            $table->string('orig_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('file_ext', 20)->nullable();
            $table->float('file_size', 8, 2)->nullable();
            $table->mediumInteger('image_width')->nullable();
            $table->mediumInteger('image_height')->nullable();
            $table->string('image_type', 20)->nullable();
            $table->string('image_size_str')->nullable();
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
        Schema::dropIfExists('uploads');
    }
}
