<?php

namespace Caimari\LaraFlex\Services;

use Caimari\LaraFlex\Models\SiteGallery;

class ShortcodeProcessor
{
    public function parse_shortcodes($content)
    {
        $content = htmlspecialchars_decode($content);  // Decodificar las entidades HTML

        $pattern = '/\[gallery id="(\d+)"\]/';
        return preg_replace_callback($pattern, function ($matches) {
            $id = $matches[1];
            $gallery = SiteGallery::with(['images' => function ($query) {
                $query->orderBy('order');
            }])->find($id);

            if ($gallery) {
                $html = '<div class="gallery slick-slider gallery-align-left">';
                foreach ($gallery->images as $image) {
                    $html .= '<div><a href="' . $image->url . '" class="colorbox" data-gallery="gallery-' . $gallery->id . '"><img src="' . $image->url . '" alt="' . $image->title . '" /></a></div>';
                }
                $html .= '</div>';
                return $html;
            } else {
                return '';
            }
        }, $content);
    }
}
