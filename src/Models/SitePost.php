<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SitePost extends Model
{
    protected $table = 'site_posts';
    protected $fillable = ['user_id', 'title', 'content', 'slug', 'description', 'status', 'sidebar_position', 'image'];
    public $timestamps = true;


    public function user()
{
    return $this->belongsTo(User::class);
}

    public function categories()
    {
        return $this->belongsToMany(SitePostCategory::class, 'site_post_category_relations', 'post_id', 'category_id');
    }


    public function tags()
    {
        return $this->belongsToMany(SitePostTag::class, 'site_post_tag_relations', 'post_id', 'tag_id');
    }

    public function views()
    {
        return $this->morphMany(SiteView::class, 'viewable');
    }

    public function comments()
    {
        return $this->hasMany(SiteComment::class)->whereNull('page_id');
    }

}

