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
        Schema::table('site_menu_items', function (Blueprint $table) {
            $table->foreign(['menu_id'], 'site_menu_items_ibfk_1')->references(['id'])->on('site_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_menu_items', function (Blueprint $table) {
            $table->dropForeign('site_menu_items_ibfk_1');
        });
    }
};
