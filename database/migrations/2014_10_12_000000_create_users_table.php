<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',['A','M','U'])->default('U')->comment('a=>admin,m=>manager, u=>user');
            $table->enum('active',['Y','N'])->default('N');
            $table->enum('two_factor',['Y','N'])->default('N');
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'dhbgraphics.user@gmail.com',
                'password' => bcrypt(12345678),
                'role' => 'A',
                'active' => 'Y',
                'email_verified_at' => now(),
            ]);

        DB::table('users')->insert(
            [
                'name' => 'Gautam',
                'username' => 'gautam',
                'email' => 'gautam@dhbgraphics.com',
                'password' => bcrypt(12345678),
                'role' => 'M',
                'active' => 'Y',
                'email_verified_at' => now(),
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
};
