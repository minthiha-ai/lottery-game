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
        Schema::create('hot_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lottery_id')->constrained()->onDelete('cascade');
            $table->string('hot_number');
            $table->string('covered_amount');
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
        Schema::dropIfExists('hot_numbers');
    }
};
