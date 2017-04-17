<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('description')->nullable();
            $table->string('locale')->nullable();
            $table->string('item_type');
            $table->string('status');
            $table->integer('article_count')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('photo_id')->nullable();
            $table->integer('seq_number')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->boolean('indeletable')->default(0);
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
        Schema::drop('items');
    }
}
