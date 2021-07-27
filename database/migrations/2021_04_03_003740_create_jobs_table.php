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

        $jobs = [[
            'client_id' => 1,
            "title"=> "Convert Figma Landing page design to Responsive bootstrap webpage",
            "description"=> "The figma file / link will be sent to you\r\n\r\nTask:\r\n- Transform into responsive bootstrap webpage with JS (slider, success state for button & video modal)\r\n- Make sure on mobile looks good.",
            'category_id' => 1,
            'subcategory_id' => 1,
            'compensation_type_id'=> 1,
            'experience_level_id' => 2,
            'job_status_id'=> 1,
            'duration_id'=> 1,
            'skills_required' => "{\"a\":\"PHP\",\"b\": \"JavaScript\",\"c\": \"MYSQL\"}",
            'budget'=> 50000.00],
            [
                'client_id' => 1,
                "title"=> "Developer needed to fix install of Laravel application",
                "description"=> "I have an existing Laravel application that is not loading for me it should be a simple fix, I need someone to make sure the database is running, the app is loading correctly etc. Laravel experience required.",
                'category_id' => 1,
                'subcategory_id' => 1,
                'compensation_type_id'=> 1,
                'experience_level_id' => 2,
                'job_status_id'=> 1,
                'duration_id'=> 2,
                'skills_required' => "{\"a\":\"PHP\",\"b\": \"Laravel\"',\"c\": \"MYSQL\"}",
                'budget'=> 40000.00],
            [
                'client_id' => 2,
                "title"=> "I Need a Developer for a fullStack role",
                "description"=> "I have a web app that I built basically its a form, what I need is to make the front end mobile first and add change some thing on the form from end.
                                    Example pulls keyboard our when opening the page on iPhone",
                'category_id' => 1,
                'subcategory_id' => 1,
                'compensation_type_id'=> 1,
                'experience_level_id' => 2,
                'job_status_id'=> 1,
                'duration_id'=> 2,
                'skills_required' => "{\"a\":\"JavaScript\",\"b\": \"ReactJs\",\"c\": \"Firebase\"}",
                'budget'=> 30000.00

            ]
        ];

        DB::table('jobs')->insert($jobs);

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
