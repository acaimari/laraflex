<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteCommentReply extends Model
{
    protected $table = 'site_comment_replies';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(SiteComment::class);
    }
}