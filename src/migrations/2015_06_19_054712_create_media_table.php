<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('imagable_id');
            $table->string('imagable_type');
            $table->string('file_name');
            $table->string('path_name');
            $table->string('storage_type');
            $table->string('type');
            $table->string('mime_type');
            $table->string('content_length');
            $table->string('caption');
            $table->string('description');
            $table->boolean('is_best_video');
            $table->boolean('is_home_image');
            $table->integer('seq_no');
            $table->integer('album_id');
            $table->integer('user_id');
            $table->integer('site_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
        Schema::drop('media');
    }
}
