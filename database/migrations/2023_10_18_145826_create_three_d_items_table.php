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
        Schema::create('three_d_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lottery_id')->constrained('three_d_lotteries')->onDelete('cascade');
            $table->foreignId('lottery_number_id')->constrained('three_d_lottery_numbers')->onDelete('cascade');
            $table->foreignId('number_id')->constrained('three_d_numbers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('price');
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
        Schema::dropIfExists('three_d_items');
    }
};
