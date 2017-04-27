<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('hash')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('primary_photo_id')->nullable();
            $table->integer('game_photo_id')->nullable();
            $table->integer('category_id');
            $table->integer('organization_id')->nullable();
            $table->integer('type_id');
            $table->integer('seq_no');
            $table->string('language', 10)->nullable();
            $table->text('locale')->nullable();
            $table->text('customs')->nullable();
            $table->integer('collection_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('published_at')->nullable();
            $table->integer('scheduled_at')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::drop('articles');
    }
}
