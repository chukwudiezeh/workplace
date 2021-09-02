<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        
        
        $cat = [
            ['name'=>'Software Develoment'],
            ['name' => 'Design & Creatives'],
            ['name' => 'Information Tech. & Networking'],
            ['name' => 'Writing & Translation'],
            ['name' => 'Administrative Support'],
            ['name' => 'Data Science & Analytics']
        ];

        DB::table('categories')->insert($cat);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
