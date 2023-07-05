<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SitePostTag extends Model
{
    protected $table = 'site_post_tags';
    protected $fillable = ['title', 'status', 'active'];
    public $timestamps = true;

    public function posts()
    {
        return $this->belongsToMany(SitePost::class, 'site_post_tag_relations', 'tag_id', 'post_id');
    }

    public function views()
{
    return $this->morphMany(SiteView::class, 'viewable');
}



}
