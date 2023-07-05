<?php

namespace Caimari\LaraFlex\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Caimari\LaraFlex\Models\SitePost;
use Caimari\LaraFlex\Models\SitePage;
use Caimari\LaraFlex\Models\SitePostCategory;
use Caimari\LaraFlex\Models\SitePostTag;

class ViewController extends Controller
{
    public function incrementViews($model)
{
    $ipAddress = request()->ip();

    // Busca una vista existente de la misma dirección IP
    $view = $model->views()->where('ip_address', $ipAddress)->first();

    if ($view) {
        // Si existe una vista de esta dirección IP, incrementa el contador de vistas
        $view->views += 1;
        $view->save();
    } else {
        // Si no existe una vista de esta dirección IP, crea una nueva
        $model->views()->create([
            'ip_address' => $ipAddress,
            'views' => 1  // Inicia el contador de vistas en 1
        ]);
    }
}

}
