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
        Schema::table('three_d_user_settings', function (Blueprint $table) {
            $table->string('t_za')->default(0);
            $table->string('p_za')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('three_d_user_settings', function (Blueprint $table) {
            //
        });
    }
};
