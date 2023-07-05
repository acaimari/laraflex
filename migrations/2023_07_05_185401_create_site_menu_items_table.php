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
        Schema::create('site_menu_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent')->nullable();
            $table->string('link')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('depth')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->string('target')->nullable();
            $table->integer('menu_id')->nullable()->index('menu_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_menu_items');
    }
};
