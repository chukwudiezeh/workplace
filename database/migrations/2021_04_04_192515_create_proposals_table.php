<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id');
            $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->text('cover_letter');
            $table->json('milestone')->nullable();
            $table->string('payment_type')->nullable();
            $table->unsignedSmallInteger('proposed_duration_id');
            $table->decimal('proposed_fee',8,2);
            $table->unsignedSmallInteger('proposal_status_id')->default(1);
            $table->foreign('proposal_status_id')->references('id')->on('proposal_status')->onDelete('cascade');
            $table->boolean('request_changes')->default(false);
            $table->json('changes_note')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}
