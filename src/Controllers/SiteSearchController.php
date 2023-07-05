<?php

namespace Caimari\LaraFlex\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Caimari\LaraFlex\Models\SitePost;
use Caimari\LaraFlex\Models\SitePage;

class SiteSearchController extends Controller
{
    public function search(Request $request)
    {

        // Obtener el nombre del tema activo
        $theme = $this->getActiveTheme();

        $query = $request->input('q');

        $pages = SitePage::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->get();

        $posts = SitePost::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

            return view("{$theme}::frontend.search", compact('pages', 'posts', 'query'));
    }

    public function getActiveTheme() 
    {
        // Obtener el tema activo de la base de datos
        $activeTheme = DB::table('site_themes')->where('active', 1)->first();
    
        // Si no hay un tema activo, usar un valor por defecto
        if (!$activeTheme) {
            return 'default';
        }
    
        return $activeTheme->name;
    }
}
