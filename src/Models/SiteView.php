<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SiteView extends Model
{
    protected $table = 'site_views';
    protected $fillable = ['ip_address', 'views'];

    public function viewable()
    {
        return $this->morphTo();
    }
}
