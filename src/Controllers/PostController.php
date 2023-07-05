<?php

namespace Caimari\LaraFlex\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Caimari\LaraFlex\Models\SitePost;
use Caimari\LaraFlex\Models\SitePostCategory;
use Caimari\LaraFlex\Models\SitePostTag;
use Caimari\LaraFlex\Models\GeneralSettings;
use App\Models\User;

class PostController extends Controller
{

    
    public function index(Request $request)
    {
        $posts = SitePost::all();
    
        // Obtener la configuración de la página de inicio
        $setHomePost = GeneralSettings::first();

                // Recorrer las páginas y obtener el número de vistas únicas
                foreach ($posts as $post) {
                    $post->uniqueViews = $post->views()->count();
                }
    
        return view('laraflex::admin.posts.index', compact('posts', 'setHomePost'));
    }
    
    
    
    public function ajaxSearch(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sortField', 'title'); // title is the default field to sort by
        $sortDirection = $request->input('sortDirection', 'asc'); // asc is the default sort direction
    
        $query = SitePost::where('title', 'like', '%' . $search . '%')
                    ->with('categories', 'tags'); // Cargar las relaciones categories y tags
    
        if (in_array($sortField, ['title', 'categories', 'tags', 'status'])) {
            $query->orderBy($sortField, $sortDirection);
        }
    
        $posts = $query->get();
    
        return response()->json($posts);
    }
    

    public function create()
    {
        $categories = SitePostCategory::all(); // Obtener todas las categorías
        $posts = SitePost::all(); // Obtener todos los posts
    
        return view('laraflex::admin.posts.create', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'slug' => 'required|max:100',
            'description' => 'nullable',
            'content' => 'nullable',
        ]);
    
        $postData = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'image' => $request->input('image'),
            'sidebar_position' => $request->input('sidebar_position'),
            'user_id' => auth()->user()->id, 
        ];
    
        $post = SitePost::create($postData);
    
        // Get the category names from the form
        $categoryNames = explode(',', $request->input('categories'));
    
        // Get the category IDs from their names
        $categoryIds = SitePostCategory::whereIn('title', $categoryNames)->pluck('id');
    
        // Sync the post's categories
        $post->categories()->sync($categoryIds);
    
        // Get the tag names from the form
        $tagNames = explode(',', $request->input('tags'));
    
        // Get the tag IDs from their names
        $tagIds = SitePostTag::whereIn('title', $tagNames)->pluck('id');
    
        // Sync the post's tags
        $post->tags()->sync($tagIds);
    
        return redirect()->route('posts.index')->with('success', 'Post creado correctamente');
    }
    

    public function edit($id)
{
    $post = SitePost::findOrFail($id);
    
    $categories = SitePostCategory::all(); // Obtener todas las categorías
    $postCategories = $post->categories->pluck('title')->toArray(); // Obtener las categorías del post
    
    $tags = SitePostTag::all(); // Obtener todos los tags
    $postTags = $post->tags->pluck('title')->toArray(); // Obtener los tags del post


    // Obtener la URL completa de la imagen si existe
    $imageUrl = $post->image ? Storage::url($post->image) : null;

    // Comprobar si el post es el post de inicio
    $homePostSetting = GeneralSettings::first();
    $isHomePost = $homePostSetting && $homePostSetting->content_id == $post->id && $homePostSetting->content_type == 'post';

    return view('laraflex::admin.posts.edit', [
        'post' => $post,
        'content' => $post->content, // Aquí usamos la propiedad content del objeto post
        'categories' => $categories,
        'postCategories' => $postCategories,
        'tags' => $tags,
        'postTags' => $postTags,
        'imageUrl' => $imageUrl,
        'isHomePost' => $isHomePost,
    ]);
}

    
    public function update(Request $request, $id)
{
    $post = SitePost::findOrFail($id);

    $post->title = $request->input('title');
    $post->slug = $request->input('slug');
    $post->content = $request->input('content');
    $post->description = $request->input('description');
    $post->status = $request->input('status');
    $post->sidebar_position = $request->input('sidebar_position');

    // Obtén los nombres de las categorías desde el formulario
    $categoryNames = explode(',', $request->input('categories'));

    // Obtén los IDs de las categorías a partir de sus nombres
    $categoryIds = SitePostCategory::whereIn('title', $categoryNames)->pluck('id');

    // Sincroniza las categorías del post
    $post->categories()->sync($categoryIds);

    
    // Obtén los nombres de los tags desde el formulario
    $tagNames = explode(',', $request->input('tags'));

    // Obtén los IDs de los tags a partir de sus nombres
    $tagIds = SitePostTag::whereIn('title', $tagNames)->pluck('id');

    // Sincroniza los tags del post
    $post->tags()->sync($tagIds);


    if ($request->has('image')) {
        $imagePath = $request->input('image');
        $imagePath = str_replace(Storage::url('/'), '', $imagePath);
        $post->image = $imagePath;
    }

    $post->save();

    return redirect()->route('posts.edit', $id)->with('success', 'Post updated successfully');
}

    
    public function removeImage($id)
{
    $post = SitePost::findOrFail($id);

    if ($post->image) {
        Storage::delete($post->image);
        $post->image = null;
        $post->save();
    }

    return redirect()->back()->with('success', 'Post image removed successfully');
}

    public function destroy($id)
    {
        $post = SitePost::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}


