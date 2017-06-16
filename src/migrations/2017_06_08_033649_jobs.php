<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_careers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('job_term')->nullable();
            $table->string('location')->default('');
            $table->string('closing_date')->nullable();
            $table->string('experience', 256)->nullable();
            $table->integer('number_hire')->nullable();
            $table->string('qualification', 256)->nullable();
            $table->string('description', 1200)->nullable();
            $table->string('age_from')->nullable();
            $table->string('age_to')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('responsibility', 3000)->default('');
            $table->string('requirement', 3000)->default('');
            $table->integer('seq_no')->default(0);
            $table->boolean('is_active')->default(0);
            $table->string('status', 20)->default('active');
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
        Schema::drop('job_careers');
    }
}
