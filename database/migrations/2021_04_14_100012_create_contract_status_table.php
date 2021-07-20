<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateContractStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_status', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        $contract_status = [
            ['name' => 'In production'],
            ['name' => 'Need Changes'],
            ['name' => 'Delayed'],
            ['name'=>'Approved for Payments'],
            ['name' => 'Completed but pending approval'],
        ];

        DB::table('contract_status')->insert($contract_status);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_status');
    }
}
