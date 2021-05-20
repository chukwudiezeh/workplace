<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('durations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $durations = [
            ['name' => 'Less than 1 week'],
            ['name' => '1 week'],
            ['name' => 'Less than 2 weeks'],
            ['name' => '2 weeks'],
            ['name' => 'Less than 1 month'],
            ['name' => '1 month'],
            ['name' => '1 to 3 months'],
            ['name' => 'More than 6 months'],
        ];

        DB::table('durations')->insert($durations);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('durations');
    }
}
