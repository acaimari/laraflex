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
        Schema::table('site_gallery_images', function (Blueprint $table) {
            $table->foreign(['site_gallery_id'], 'site_gallery_images_ibfk_1')->references(['id'])->on('site_galleries')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_gallery_images', function (Blueprint $table) {
            $table->dropForeign('site_gallery_images_ibfk_1');
        });
    }
};
