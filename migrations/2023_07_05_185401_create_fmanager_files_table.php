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
        Schema::create('fmanager_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ext');
            $table->integer('size');
            $table->unsignedBigInteger('user_id');
            $table->string('url');
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
        Schema::dropIfExists('fmanager_files');
    }
};
