<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_title')->nullable();
            $table->string('site_url')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('keywords')->nullable();
            $table->string('content_type')->nullable()->default('page');
            $table->integer('content_id')->default(1);
            $table->enum('status_page', ['0', '1'])->default('1')->comment('0 Offline, 1 Online');
            $table->enum('email_verification', ['0', '1'])->default('0')->comment('0 Off, 1 On');
            $table->string('email_no_reply', 200)->nullable();
            $table->string('email_admin', 200)->nullable();
            $table->string('site_email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('github')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('instagram')->nullable();
            $table->string('rss')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('reddit')->nullable();
            $table->string('telegram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->enum('captcha', ['on', 'off'])->default('on');
            $table->enum('payment_gateway', ['PayPal', 'Stripe'])->default('PayPal');
            $table->string('currency_position', 100)->default('left');
            $table->enum('facebook_login', ['on', 'off'])->default('off');
            $table->enum('google_login', ['on', 'off'])->default('off');
            $table->enum('registration_active', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->enum('account_verification', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->string('logo', 100)->nullable();
            $table->string('logo_2', 100)->nullable();
            $table->string('favicon', 100)->nullable();
            $table->string('home_index', 100)->nullable();
            $table->string('bg_gradient', 100)->nullable();
            $table->string('img_1', 100)->nullable();
            $table->string('img_2', 100)->nullable();
            $table->string('img_3', 100)->nullable();
            $table->string('img_4', 100)->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('color_default', 100)->nullable();
            $table->string('version', 5)->nullable();
            $table->string('link_cookies', 200)->nullable();
            $table->unsignedInteger('story_length')->nullable();
            $table->enum('maintenance_mode', ['on', 'off'])->default('off');
            $table->string('company', 100)->nullable();
            $table->string('country')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('zip', 100)->nullable();
            $table->string('vat', 100)->nullable();
            $table->unsignedInteger('home_style')->nullable();
            $table->enum('payout_method_paypal', ['on', 'off'])->default('on');
            $table->enum('payout_method_bank', ['on', 'off'])->default('on');
            $table->enum('twitter_login', ['on', 'off'])->default('off');
            $table->enum('hide_admin_profile', ['on', 'off'])->default('off');
            $table->enum('requests_verify_account', ['on', 'off'])->default('on');
            $table->string('navbar_background_color', 30)->nullable();
            $table->string('navbar_text_color', 30)->nullable();
            $table->string('footer_background_color', 30)->nullable();
            $table->string('footer_text_color', 30)->nullable();
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->string('genders', 250)->nullable();
            $table->string('cover_default', 100)->nullable();
            $table->enum('who_can_see_content', ['all', 'users'])->default('all');
            $table->enum('users_can_edit_post', ['on', 'off'])->default('on');
            $table->enum('disable_banner_cookies', ['on', 'off'])->default('off');
            $table->unsignedInteger('maximum_files_post')->default(5);
            $table->unsignedInteger('maximum_files_msg')->default(5);
            $table->enum('captcha_contact', ['on', 'off'])->default('on');
            $table->char('type_announcement', 10)->default('primary');
            $table->enum('referral_system', ['on', 'off'])->default('off');
            $table->unsignedInteger('percentage_referred')->default(5);
            $table->char('referral_transaction_limit', 10)->default('1');
            $table->unsignedTinyInteger('stripe_connect')->default(0);
            $table->longText('stripe_connect_countries')->nullable();
            $table->boolean('disable_login_register_email')->default(false);
            $table->boolean('disable_contact')->default(false);
            $table->boolean('disable_new_post_notification')->default(false);
            $table->boolean('allow_zip_files')->default(true);
        });

         // Insertar un registro con los valores específicos
         DB::table('general_settings')->insert([
            'site_title' => 'Laraflex',
            'site_description' => 'This is the general description of the site. You can replace it from the General Settings section in the administration panel configuration.',
            'site_email' => 'laraflex-org@gmail.com',
        ]);
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
