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
        Schema::table('site_comment_replies', function (Blueprint $table) {
            $table->foreign(['comment_id'], 'site_comment_replies_ibfk_1')->references(['id'])->on('site_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_comment_replies', function (Blueprint $table) {
            $table->dropForeign('site_comment_replies_ibfk_1');
        });
    }
};
