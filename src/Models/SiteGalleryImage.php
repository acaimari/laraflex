<?php

namespace Caimari\LaraFlex\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteGalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_gallery_id',
        'url',
        'title',
        'description',
        'order',
    ];

    public function gallery()
    {
        return $this->belongsTo('Caimari\LaraFlex\Models\SiteGallery', 'gallery_id');
    }
}
