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
        Schema::create('three_d_lottery_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lottery_id')->constrained('three_d_lotteries')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('three_d_users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('total_numbers');
            $table->string('total_price');
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
        Schema::dropIfExists('three_d_lottery_numbers');
    }
};
