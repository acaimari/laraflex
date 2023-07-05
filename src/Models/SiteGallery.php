<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function images()
    {
        return $this->hasMany('Caimari\LaraFlex\Models\SiteGalleryImage');
    }
}
