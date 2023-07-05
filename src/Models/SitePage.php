<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use HasFactory;

    protected $table = 'site_pages';
    
    protected $fillable = [
        'title',
        'content',
        'slug',
        'description',
        'keywords',
        'lang',
        'access',
        'status',
        'sidebar_position',
        'image',
    ];

    public function views()
    {
        return $this->morphMany(SiteView::class, 'viewable');
    }

    public function comments()
    {
        return $this->hasMany(SiteComment::class)->whereNull('post_id');
    }

}
