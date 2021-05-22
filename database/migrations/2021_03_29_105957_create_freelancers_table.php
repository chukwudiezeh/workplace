<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // $table->unsignedSmallInteger('certification_id');
            // $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('cascade');
            // $table->unsignedSmallInteger('portfolio_id');
            // $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            // $table->unsignedSmallInteger('education_id');
            // $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
            // $table->unsignedSmallInteger('employment_history_id');
            // $table->foreign('employment_history_id')->references('id')->on('employment_histories')->onDelete('cascade');
            // $table->unsignedSmallInteger('freelance_skill_id');
            // $table->foreign('freelance_skill_id')->references('id')->on('freelance_skills')->onDelete('cascade');
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
