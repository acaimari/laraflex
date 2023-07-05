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
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('keywords');
            $table->unsignedInteger('update_length')->comment('The max length of updates');
            $table->enum('status_page', ['0', '1'])->default('1')->comment('0 Offline, 1 Online');
            $table->enum('email_verification', ['0', '1'])->comment('0 Off, 1 On');
            $table->string('email_no_reply', 200);
            $table->string('email_admin', 200);
            $table->enum('captcha', ['on', 'off'])->default('on');
            $table->unsignedInteger('file_size_allowed')->comment('Size in Bytes');
            $table->text('google_analytics');
            $table->string('paypal_account', 200);
            $table->string('twitter', 200);
            $table->string('facebook', 200);
            $table->string('pinterest', 200);
            $table->string('instagram', 200);
            $table->text('google_adsense');
            $table->char('currency_symbol', 10);
            $table->string('currency_code', 20);
            $table->unsignedInteger('min_subscription_amount');
            $table->enum('payment_gateway', ['PayPal', 'Stripe'])->default('PayPal');
            $table->string('min_width_height_image', 100);
            $table->unsignedInteger('fee_commission');
            $table->unsignedInteger('max_subscription_amount');
            $table->string('date_format', 200);
            $table->string('link_privacy', 200);
            $table->string('link_terms', 200);
            $table->string('currency_position', 100)->default('left');
            $table->enum('facebook_login', ['on', 'off'])->default('off');
            $table->unsignedInteger('amount_min_withdrawal');
            $table->string('youtube', 200);
            $table->string('github', 200);
            $table->unsignedInteger('comment_length');
            $table->unsignedInteger('days_process_withdrawals');
            $table->enum('google_login', ['on', 'off'])->default('off');
            $table->unsignedTinyInteger('number_posts_show');
            $table->unsignedTinyInteger('number_comments_show');
            $table->enum('registration_active', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->enum('account_verification', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->string('logo', 100);
            $table->string('logo_2', 100);
            $table->string('favicon', 100);
            $table->string('home_index', 100);
            $table->string('bg_gradient', 100);
            $table->string('img_1', 100);
            $table->string('img_2', 100);
            $table->string('img_3', 100);
            $table->string('img_4', 100);
            $table->string('avatar', 100);
            $table->enum('show_counter', ['on', 'off'])->default('on');
            $table->string('color_default', 100);
            $table->enum('decimal_format', ['comma', 'dot'])->default('dot');
            $table->string('version', 5);
            $table->string('link_cookies', 200);
            $table->unsignedInteger('story_length');
            $table->enum('maintenance_mode', ['on', 'off'])->default('off');
            $table->string('company', 100);
            $table->string('country');
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('zip', 100);
            $table->string('vat', 100);
            $table->enum('widget_creators_featured', ['on', 'off'])->default('on');
            $table->unsignedInteger('home_style');
            $table->unsignedInteger('file_size_allowed_verify_account');
            $table->enum('payout_method_paypal', ['on', 'off'])->default('on');
            $table->enum('payout_method_bank', ['on', 'off'])->default('on');
            $table->unsignedInteger('min_tip_amount');
            $table->unsignedInteger('max_tip_amount');
            $table->unsignedInteger('min_ppv_amount');
            $table->unsignedInteger('max_ppv_amount');
            $table->unsignedInteger('min_deposits_amount');
            $table->unsignedInteger('max_deposits_amount');
            $table->enum('button_style', ['rounded', 'normal'])->default('rounded');
            $table->enum('twitter_login', ['on', 'off'])->default('off');
            $table->enum('hide_admin_profile', ['on', 'off'])->default('off');
            $table->enum('requests_verify_account', ['on', 'off'])->default('on');
            $table->string('navbar_background_color', 30);
            $table->string('navbar_text_color', 30);
            $table->string('footer_background_color', 30);
            $table->string('footer_text_color', 30);
            $table->enum('preloading', ['on', 'off'])->default('off');
            $table->string('preloading_image', 100);
            $table->enum('watermark', ['on', 'off'])->default('on');
            $table->enum('earnings_simulator', ['on', 'off'])->default('on');
            $table->text('custom_css');
            $table->text('custom_js');
            $table->enum('alert_adult', ['on', 'off'])->default('off');
            $table->string('genders', 250);
            $table->string('cover_default', 100);
            $table->enum('who_can_see_content', ['all', 'users'])->default('all');
            $table->enum('users_can_edit_post', ['on', 'off'])->default('on');
            $table->enum('disable_wallet', ['on', 'off'])->default('on');
            $table->enum('disable_banner_cookies', ['on', 'off'])->default('off');
            $table->enum('wallet_format', ['real_money', 'credits', 'points', 'tokens'])->default('real_money');
            $table->unsignedInteger('maximum_files_post')->default(5);
            $table->unsignedInteger('maximum_files_msg')->default(5);
            $table->longText('announcement');
            $table->string('announcement_show', 100);
            $table->string('announcement_cookie', 20);
            $table->unsignedInteger('limit_categories')->default(3);
            $table->enum('captcha_contact', ['on', 'off'])->default('on');
            $table->enum('disable_tips', ['on', 'off'])->default('off');
            $table->enum('payout_method_payoneer', ['on', 'off'])->default('off');
            $table->enum('payout_method_zelle', ['on', 'off'])->default('off');
            $table->char('type_announcement', 10)->default('primary');
            $table->enum('referral_system', ['on', 'off'])->default('off');
            $table->enum('auto_approve_post', ['on', 'off'])->default('on');
            $table->enum('watermark_on_videos', ['on', 'off'])->default('on');
            $table->unsignedInteger('percentage_referred')->default(5);
            $table->char('referral_transaction_limit', 10)->default('1');
            $table->enum('video_encoding', ['on', 'off'])->default('off');
            $table->enum('live_streaming_status', ['on', 'off'])->default('off');
            $table->unsignedInteger('live_streaming_minimum_price')->default(5);
            $table->unsignedInteger('live_streaming_max_price')->default(100);
            $table->string('agora_app_id', 200);
            $table->string('tiktok', 200);
            $table->string('snapchat', 200);
            $table->unsignedInteger('limit_live_streaming_paid');
            $table->unsignedInteger('limit_live_streaming_free');
            $table->enum('live_streaming_free', ['0', '1'])->default('0');
            $table->char('type_withdrawals', 50)->default('custom');
            $table->boolean('shop')->default(false);
            $table->unsignedInteger('min_price_product')->default(5);
            $table->unsignedInteger('max_price_product')->default(100);
            $table->boolean('digital_product_sale')->default(false);
            $table->boolean('custom_content')->default(false);
            $table->boolean('tax_on_wallet')->default(true);
            $table->unsignedTinyInteger('stripe_connect')->default(0);
            $table->longText('stripe_connect_countries');
            $table->boolean('physical_products')->default(false);
            $table->boolean('disable_login_register_email')->default(false);
            $table->boolean('disable_contact')->default(false);
            $table->unsignedInteger('specific_day_payment_withdrawals');
            $table->boolean('disable_new_post_notification')->default(false);
            $table->boolean('disable_search_creators')->default(false);
            $table->boolean('search_creators_genders')->default(false);
            $table->boolean('generate_qr_code')->default(false);
            $table->boolean('autofollow_admin')->default(false);
            $table->boolean('allow_zip_files')->default(true);
            $table->string('reddit', 200);
            $table->string('telegram', 200);
            $table->string('linkedin', 200);
            $table->boolean('push_notification_status')->default(false);
            $table->string('onesignal_appid', 150);
            $table->string('onesignal_restapi', 150);
            $table->boolean('status_pwa')->default(true);
            $table->boolean('zip_verification_creator')->default(true);
            $table->unsignedInteger('amount_max_withdrawal');
            $table->boolean('story_status')->default(false);
            $table->boolean('story_image')->default(true);
            $table->boolean('story_text')->default(true);
            $table->unsignedInteger('story_max_videos_length')->default(30);
            $table->enum('payout_method_western_union', ['on', 'off'])->default('off');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
    }
};
