<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->unsignedSmallInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        $sub_cat = [
            ['name'=>'Web Development', 'category_id'=>1],
            ['name' => 'Mobile Development', 'category_id' =>1],
            ['name' => 'Game Development', 'category_id' =>1],
            ['name' => 'Desktop Development', 'category_id' =>1],
            ['name' => 'Quality Assurance and testing', 'category_id' =>1],
            ['name' => 'Product management', 'category_id' =>1],

        ];

        DB::table('subcategories')->insert($sub_cat);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
}
