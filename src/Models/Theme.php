<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'site_themes';

    protected $fillable = [
        'name',
        'version',
        'site_title',
        'site_url',
        'site_description',
        'site_keywords',
        'site_email',
        'facebook',
        'twitter',
        'linkedin',
        'google_plus',
        'github',
        'pinterest',
        'instagram',
        'rss',
        'youtube',
        'vimeo',
        'tiktok',
        'snapchat',
        'reddit',
        'telegram',
        'whatsapp',
        'site_phone',
        'service_provider',
        'active',
        'description',
        'menu_locations',
        'theme_options',
        'provider',
        'site_name',
        'logo',
        'logo_2',
        'favicon',
        'title_active',
        'header_image_active',
        'header_sub_bar_active',
        'breadcrumb_active',
        'main_content_active',
        'footer_active',
        'footer_2_active',
        'footer_copyright_active',
        'created_at',
        'updated_at',
        'color_default',
        'navbar_background_color',
        'navbar_text_color',
        'footer_background_color',
        'footer_text_color',
        'custom_css',
        'custom_js',
        'captcha',
        'site_company',
        'country',
        'address',
        'city',
        'zip',
        'google_analytics',
        'google_adsense',
        'currency_symbol',
        'date_format',
        'registration_active',
        'account_verification',
        'requests_verify_account',
        'limit_categories',
        'disable_login_register_email',
        'disable_contact',
        'status_pwa',
        'sidebar_post_cat_active',
        'sidebar_post_tab_active',
        'sidebar_text_widget_active',
        'sidebar_search_active'
    ];
    

    protected $casts = [
        'options' => 'array',
    ];
}
