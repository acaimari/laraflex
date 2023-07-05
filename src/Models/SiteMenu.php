<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    protected $table = 'site_menus';
    protected $fillable = ['title', 'location'];
    public $timestamps = true;

    public function items()
    {
        return $this->hasMany(SiteMenuItem::class, 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
    
    public static function byName($name)
    {
        return self::where('title', '=', $name)->first();
    }
}
