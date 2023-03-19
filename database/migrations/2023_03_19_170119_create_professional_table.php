<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('service1')->nullable();
            $table->time('time_service1')->nullable();
            $table->string('service2')->nullable();
            $table->time('time_service2')->nullable();
            $table->string('service3')->nullable();
            $table->time('time_service3')->nullable();
            $table->string('service4')->nullable();
            $table->time('time_service4')->nullable();
            $table->string('service5')->nullable();
            $table->time('time_service5')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('professionals');
    }
}
