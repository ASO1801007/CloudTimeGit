<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->nullable();
            $table->string('intro',255)->nullable();
            $table->string('location',255)->nullable();
            $table->string('job',50)->nullable();
            $table->string('high',50)->nullable();
            $table->string('junior_high',50)->nullable();
            $table->string('elementary',50)->nullable();
            $table->string('profile_pic',255)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('intro');
            $table->dropColumn('location');
            $table->dropColumn('job');
            $table->dropColumn('high');
            $table->dropColumn('junior_high');
            $table->dropColumn('elementary');
            $table->dropColumn('profile_pic');
        });
    }
}
