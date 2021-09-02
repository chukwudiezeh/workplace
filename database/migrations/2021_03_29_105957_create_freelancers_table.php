<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('overview')->nullable();
            $table->text('address')->nullable();
            $table->unsignedSmallInteger('experience_level_id')->nullable();
            $table->foreign('experience_level_id')->references('id')->on('experience_levels')->onDelete('cascade');
            $table->unsignedSmallInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedSmallInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->decimal('hourly_rate',5,2)->nullable();
            $table->smallInteger('job_success_rate')->nullable();
            $table->json('skills')->nullable();
            $table->string('position')->nullable();
            $table->integer('earnings')->nullable();
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
        Schema::dropIfExists('freelancers');
    }
}
