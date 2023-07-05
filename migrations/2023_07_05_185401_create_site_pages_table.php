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
        Schema::create('site_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['page'])->default('page');
            $table->string('title', 150);
            $table->mediumText('content')->nullable();
            $table->string('slug', 100)->index('slug');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->char('lang', 10)->default('en');
            $table->string('access', 50)->default('all');
            $table->enum('sidebar_position', ['left', 'right', 'none']);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('site_pages');
    }
};
