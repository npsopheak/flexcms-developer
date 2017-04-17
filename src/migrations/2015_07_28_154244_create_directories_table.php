<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hash')->unique();
            $table->string('short_description', 256)->nullable();
            $table->string('social_issues', 256);
            $table->string('solutions', 256);
            $table->string('main_activities', 256);
            $table->string('impact', 256);
            $table->string('description', 1200);
            $table->integer('logo_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('phones', 50)->nullable();
            $table->string('websites', 400)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('emails', 100)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_active')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::drop('directories');
    }
}
