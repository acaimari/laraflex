<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SitePostCategory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'site_post_categories';
    protected $fillable = ['title', 'slug', 'status'];
    public $timestamps = true;

    public function posts()
    {
        return $this->belongsToMany(SitePost::class, 'site_post_category_relations', 'category_id', 'post_id');
    }

    public function views()
{
    return $this->morphMany(SiteView::class, 'viewable');
}

}
