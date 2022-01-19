<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->dateTime('open_date');
            $table->string('thumbnail',255);
            $table->string('intro',255)->nullable();
            $table->string('entry_code',50);
            $table->foreignId('user_id')->constrained();
            $table->string('open_place')->nullable();
            $table->string('lat',50)->nullable();
            $table->string('lng',50)->nullable();
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
        Schema::dropIfExists('capsules');
    }
}
