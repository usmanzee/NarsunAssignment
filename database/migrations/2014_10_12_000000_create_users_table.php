<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password')->nullable();
            $table->tinyInteger('type')->default(0)->comment('1 for admin, 2 for user');
            $table->string('user_name')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'user_name' => 'admin',
            'type' => 1
        ]);
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
