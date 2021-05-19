<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('title');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedSmallInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->unsignedSmallInteger('compensation_type_id');
            $table->foreign('compensation_type_id')->references('id')->on('compensation_types')->onDelete('cascade');
            $table->unsignedSmallInteger('experience_level_id');
            $table->foreign('experience_level_id')->references('id')->on('experience_levels')->onDelete('cascade');
            $table->unsignedSmallInteger('job_status_id');
            $table->foreign('job_status_id')->references('id')->on('job_status')->onDelete('cascade');
            $table->unsignedSmallInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->text('description');
            $table->json('skills_required');
            $table->decimal('budget',8,2);
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
        Schema::dropIfExists('jobs');
    }
}
