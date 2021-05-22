<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('freelancer_id');
            $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedBigInteger('proposal_id');
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->unsignedSmallInteger('compensation_type_id');
            $table->foreign('compensation_type_id')->references('id')->on('compensation_types')->onDelete('cascade');
            $table->decimal('contract_fee',8,2);
            $table->unsignedSmallInteger('contract_status_id')->default(5);
            $table->foreign('contract_status_id')->references('id')->on('contract_status')->onDelete('cascade');
            $table->timestamps();
        });

//        $con = [
//            [
//         'client_id'=> 1,
//         'freelancer_id'=> 2,
//         'job_id'=> 12,
//         'proposal_id'=> 11,
//         'starts_at'=> now(),
//         'ends_at'=> now(),
//         'compensation_type_id'=> 1,
//         'contract_fee'=> "150000.00",
//         'contract_status_id'=> 1],
//        [
//            'client_id'=> 2,
//            'freelancer_id'=> 6,
//            'job_id'=> 19,
//            'proposal_id'=> 20,
//            'starts_at'=> now(),
//            'ends_at'=> now(),
//            'compensation_type_id'=> 1,
//            'contract_fee'=> "140000.00",
//            'contract_status_id'=> 1],
//
//            [
//                'client_id'=> 1,
//                'freelancer_id'=> 99,
//                'job_id'=> 12,
//                'proposal_id'=> 11,
//                'starts_at'=> now(),
//                'ends_at'=> now(),
//            'compensation_type_id'=> 1,
//            'contract_fee'=> "20000.00",
//                'contract_status_id'=> 1],
//
//            [
//                'client_id'=> 2,
//                'freelancer_id'=> 101,
//                'job_id'=> 115,
//                'proposal_id'=> 101,
//                'starts_at'=> now(),
//                'ends_at'=> now(),
//                'compensation_type_id'=> 1,
//                'contract_fee'=> "200000.00",
//                'contract_status_id'=> 1],
//        ];
//
//        \Illuminate\Support\Facades\DB::table('contracts')->insert($con);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
