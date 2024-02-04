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
        Schema::create('three_d_user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('three_d_users')->onDelete('cascade');
            $table->string('sales')->default(0);
            $table->string('za')->default(0);
            $table->string('limit')->default(0);
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
        Schema::dropIfExists('three_d_user_settings');
    }
};
