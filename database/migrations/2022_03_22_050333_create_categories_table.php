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
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('category_name');
                $table->string('description')->nullable();
                $table->integer('parent_id')->nullable();
                $table->enum('active', ['Y', 'N'])->default('Y');
                $table->timestamps();
            });

        DB::table('categories')->insert(
            [
                'category_name' => 'Printing',
                'active' => 'Y',
            ]);
        DB::table('categories')->insert(
            [
                'category_name' => 'Signs',
                'active' => 'Y',
            ]);
        DB::table('categories')->insert(
        [
            'category_name' => 'Larger Format',
            'active' => 'Y',
        ]);

        DB::table('categories')->insert(
            [
                'category_name' => 'Vehicle Graphics',
                'active' => 'Y',
            ]);

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
};
