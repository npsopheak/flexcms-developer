<?php

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
            $table->string('name',30);
            $table->string('email', 30)->unique();
            $table->string('role',30);
            $table->string('password', 60);
            $table->string('access_token',256)->nullable();
            $table->dateTime('expires_in')->nullable();
            $table->boolean('is_login')->nullable();
            $table->integer('site_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('photo_url')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
