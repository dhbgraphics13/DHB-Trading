<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('order_id');
            $table->text('title')->nullable();
            $table->text('details')->nullable();
            $table->text('comment')->nullable()->comment('final comment');
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0=>pending,1=>process,2=>done,3=>cancel');
            $table->date('due_date')->nullable()->comment('not necessary its work up down');
            $table->string('phone');
            $table->string('uuid');
            $table->date('job_done_on')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
