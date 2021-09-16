<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->date('birthday')->nullable();
            $table->string('intro',255)->nullable();
            $table->string('location',255)->nullable();
            $table->string('job',50)->nullable();
            $table->string('high',50)->nullable();
            $table->string('junior_high',50)->nullable();
            $table->string('elementary',50)->nullable();
            $table->string('profile_pic',255);
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('user_infos');
    }
}
