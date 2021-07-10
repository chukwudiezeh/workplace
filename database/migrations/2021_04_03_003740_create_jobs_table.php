<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('title');
            $table->unsignedSmallInteger('category_id');
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

        $job = [

                'client_id' => 1,
                "title"=> "Convert Figma Landing page design to Responsive bootstrap webpage",
                "description"=> "The figma file / link will be sent to you\r\n\r\nTask:\r\n- Transform into responsive bootstrap webpage with JS (slider, success state for button & video modal)\r\n- Make sure on mobile looks good.",
                'category_id' => 1,
                'subcategory_id' => 1,
                'compensation_type_id'=> 1,
                'experience_level_id' => 2,
                'job_status_id'=> 1,
                'duration_id'=> 1,
                'skills_required' => "{\"a\":1,\"b\": 2,\"c\": 3}",
                'budget'=> 50000.00

        ];

        DB::table('jobs')->insert($job);
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
