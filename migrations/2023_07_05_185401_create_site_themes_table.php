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
        Schema::create('site_themes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('version', 5)->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_url')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_keywords')->nullable();
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
            $table->string('site_phone')->nullable();
            $table->string('service_provider')->nullable();
            $table->boolean('active')->nullable()->default(false);
            $table->text('description')->nullable();
            $table->text('menu_locations')->nullable();
            $table->text('theme_options')->nullable();
            $table->text('theme_dynamic_btn_options')->nullable();
            $table->string('provider')->nullable();
            $table->string('site_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('favicon')->nullable();
            $table->enum('title_active', ['0', '1'])->default('1');
            $table->enum('sidebar_post_cat_active', ['0', '1'])->default('1');
            $table->enum('sidebar_post_tab_active', ['0', '1'])->default('1');
            $table->enum('sidebar_text_widget_active', ['0', '1'])->default('1');
            $table->enum('sidebar_search_active', ['0', '1'])->default('1');
            $table->enum('header_image_active', ['0', '1'])->default('1');
            $table->enum('header_sub_bar_active', ['0', '1'])->default('1');
            $table->enum('breadcrumb_active', ['0', '1'])->default('1');
            $table->enum('main_content_active', ['0', '1'])->default('1');
            $table->enum('footer_active', ['0', '1'])->default('1');
            $table->enum('footer_2_active', ['0', '1'])->default('0');
            $table->enum('footer_copyright_active', ['0', '1'])->default('1');
            $table->timestamps();
            $table->string('color_default', 100)->nullable();
            $table->string('navbar_background_color', 30)->nullable();
            $table->string('navbar_text_color', 30)->nullable();
            $table->string('footer_background_color', 30)->nullable();
            $table->string('footer_text_color', 30)->nullable();
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->enum('captcha', ['on', 'off'])->default('on');
            $table->string('site_company', 100)->nullable();
            $table->string('country')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('zip', 100)->nullable();
            $table->text('google_analytics')->nullable();
            $table->text('google_adsense')->nullable();
            $table->char('currency_symbol', 10)->nullable();
            $table->string('date_format', 200)->nullable();
            $table->enum('registration_active', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->enum('account_verification', ['0', '1'])->default('1')->comment('0 No, 1 Yes');
            $table->enum('requests_verify_account', ['on', 'off'])->default('on');
            $table->unsignedInteger('limit_categories')->default(3);
            $table->boolean('disable_login_register_email')->default(false);
            $table->boolean('disable_contact')->default(false);
            $table->boolean('status_pwa')->default(true);
        });
    


     // Insertar registros
     DB::table('site_themes')->insert([
        'name' => 'plexus',
        'site_title' => 'Plexus',
        'version' => '1.0.1',
        'active' => '1',
        'menu_locations' => json_encode([
            'nav' => 'Header',
            'footer' => 'Footer'
        ]),
        'theme_dynamic_btn_options' => json_encode([
            'buttons' => [
                [
                    'label' => 'Post Tab Dyamic',
                    'value' => 'sidebar_post_tab_active'
                ],
                [
                    'label' => 'Button 2',
                    'value' => 'footer_active'
                ]
            ]
        ]),
    ]);
}

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('site_themes');
            }


};


