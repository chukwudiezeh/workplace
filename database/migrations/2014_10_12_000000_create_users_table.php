<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('email', 50)->unique();
            $table->string('phone',13);
            $table->string('password');
            $table->boolean('email_verified')->default(true);
            $table->boolean('phone_verified')->default(true);
            $table->timestamp('phone_verified_at')->useCurrent();
            $table->timestamp('email_verified_at')->useCurrent();
            $table->unsignedSmallInteger('user_type_id');
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        $user = [
                'firstname' => 'Nnamdi',
                'lastname' => 'Ijeh',
                'email' => 'nnamdiijeh@email.com',
                'password' => \Illuminate\Support\Facades\Hash::make('Rootuser1'),
                'phone' => '08187332322',
                'email_verified' => 1,
                'phone_verified' => 1,
                "phone_verified_at"=> "2021-07-02 17:16:37",
                "user_type_id"=> 2,
                "status"=> 1
            ];
        DB::table('users')->insert($user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
