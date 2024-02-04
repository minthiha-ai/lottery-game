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
        Schema::table('three_d_items', function (Blueprint $table) {
            $table->dropForeign('three_d_items_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('three_d_items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('three_d_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('three_d_items', function (Blueprint $table) {
            $table->dropForeign('three_d_items_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
