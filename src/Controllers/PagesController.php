<?php

namespace Caimari\LaraFlex\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Caimari\LaraFlex\Models\SitePage;
use Caimari\LaraFlex\Models\GeneralSettings;

class PagesController extends Controller
{
    
    public function index()
    {
        $pages = SitePage::orderBy('created_at')->paginate(20); // Listar 20 páginas por página
    
        // Obtener la configuración de la página de inicio
        $setHomePage = GeneralSettings::first();
    
        // Recorrer las páginas y obtener el número de vistas únicas
        foreach ($pages as $page) {
            $page->uniqueViews = $page->views()->count();
        }
    
        return view('laraflex::admin.pages.index', compact('pages', 'setHomePage'));
    }
    

    public function create()
    {
        $pages = SitePage::all();
    
        return view('laraflex::admin.pages.create', compact('pages'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'content' => 'nullable',
            'slug' => 'required|max:100',
            // 'description' => 'required',
             'status' => 'required|in:0,1', // Agregamos validación para el campo status
            'sidebar_position' => 'required|in:left,right,none', // Agregamos validación para el campo sidebar_position
        ]);
    
        SitePage::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'sidebar_position' => $request->sidebar_position,
            'image' => $request->image,
            // Agrega aquí otros campos que necesites guardar
        ]);
    
        return redirect()->route('pages.index')->with('success', 'Página creada correctamente');
    }
    

    public function edit($id)
    {
        $page = SitePage::findOrFail($id);
    
        // Comprobar si la página es la página de inicio
        $homePageSetting = GeneralSettings::first();
        $isHomePage = $homePageSetting && $homePageSetting->content_id == $page->id && $homePageSetting->content_type == 'page';
    
        return view('laraflex::admin.pages.edit', compact('page', 'isHomePage'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:150',
            'content' => 'nullable',
            'slug' => 'required|max:100',
            'status' => 'required|in:0,1', // Agregamos validación para el campo status
            'sidebar_position' => 'required|in:left,right,none', // Agregamos validación para el campo sidebar_position
        ]);
    
        $page = SitePage::findOrFail($id);
        $page->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'status' => $request->status,
            'sidebar_position' => $request->sidebar_position,
            'image' => $request->image,
            // Agrega aquí otros campos que necesites actualizar
        ]);
    
        return redirect()->route('pages.edit', $id)->with('success', 'Página actualizada correctamente');
    }
    
    
    public function destroy($id)
    {
        $page = SitePage::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Página eliminada correctamente');
    }
}
