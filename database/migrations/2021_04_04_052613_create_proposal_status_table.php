<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProposalStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_status', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->timestamps();
        });


        $prop_stats = [
            ['name' => 'pending'],
            ['name'=> 'accepted'],
            ['name'=> 'declined'],
            ['name'=> 'withdrawn'],
            ['name' => 'need changes']
        ];

        DB::table('proposal_status')->insert($prop_stats);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_status');
    }
}
