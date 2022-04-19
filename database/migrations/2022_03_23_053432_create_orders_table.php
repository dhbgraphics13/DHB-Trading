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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->mediumText('order_details')->nullable();
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0=>pending,1=>process,2=>done,3=>cancel');
            $table->date('due_date')->nullable()->comment('not necessary its work up down');
            $table->string('payment_method')->nullable();
            $table->decimal('total_price',18,4)->nullable();
            $table->string('uuid');
            $table->date('job_done_on')->nullable();
            $table->timestamps();
             $table->date('deleted_at')->nullable();
        });
    }

 /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
