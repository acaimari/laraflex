<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Model;

class SiteMenuItem extends Model
{
    protected $table = 'site_menu_items';
    protected $fillable = ['title', 'name', 'slug', 'label', 'sort', 'parent', 'depth', 'link', 'type', 'target', 'menu_id'];
    public $timestamps = true;

    public function siteMenu()
    {
        return $this->belongsTo(SiteMenu::class, 'menu_id');
    }

    public function getsons($id)
    {
        return $this->where('parent', $id)->get();
    }

    public function getall($id)
    {
        return $this->where('menu_id', $id)->orderBy('sort', 'asc')->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu_id', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo(SiteMenu::class, 'menu_id');
    }

    public function child()
    {
        return $this->hasMany(SiteMenuItem::class, 'parent')->orderBy('sort', 'ASC');
    }

}
