<?php

namespace Caimari\LaraFlex\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Caimari\LaraFlex\Models\SiteGallery;
use Caimari\LaraFlex\Models\SiteGalleryImage;

class SiteGalleriesController extends Controller
{
    public function index()
    {
        $galleries = SiteGallery::all();
        return view('laraflex::admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('laraflex::admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        SiteGallery::create($request->all());

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery created successfully.');
    }

    public function edit($id)
    {
        $gallery = SiteGallery::with(['images' => function($query) {
            $query->orderBy('order');
        }])->find($id);
    
        return view('laraflex::admin.galleries.edit', compact('gallery'));
    }
    

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'images' => 'required|array'
        ]);
    
        // Encontrar la galería y actualizar la información
        $gallery = SiteGallery::find($id);
        $gallery->update($request->all());
    
        // Borrar las imágenes existentes de la galería
        SiteGalleryImage::where('site_gallery_id', $gallery->id)->delete();
    
        // Recoger las imágenes del formulario y guardarlas en la base de datos
        foreach ($request->images as $order => $url) {
            $image = new SiteGalleryImage;
            $image->site_gallery_id = $gallery->id;
            $image->url = $url;
            $image->order = $order + 1; // Orden empezando desde 1
            $image->save();
        }
    
        // Redirigir al usuario a la vista de edición de la galería
        return redirect()->route('galleries.edit', ['id' => $gallery->id])->with('success', 'Gallery updated successfully!');
    }
    
    

    public function destroy($id)
    {
        SiteGallery::find($id)->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
}
