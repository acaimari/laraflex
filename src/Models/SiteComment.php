<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteComment extends Model
{
    protected $table = 'site_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(SiteCommentReply::class, 'comment_id');
    }

    
    public function post()
    {
        return $this->belongsTo(SitePost::class);
    }

    public function page()
    {
        return $this->belongsTo(SitePage::class);
    }
}