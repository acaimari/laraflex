<?php

namespace Caimari\LaraFlex\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Closure;


use Caimari\LaraFlex\Models\SitePage;
use Caimari\LaraFlex\Models\SitePost;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Comprueba si el usuario está logeado y es admin
        if (!auth()->check() || auth()->user()->role != 'admin') {
            return redirect('panel/login');
        }
    
        $route = $request->path();
        $hasRootRoute = $this->hasRootRoute();
        $numberOfPages = SitePage::count();
        $numberOfUsers = User::count();
        $numberOfPosts = SitePost::count();
    
        $systemRoutes = $this->getSystemRoutes(); // Obtener la lista de rutas del sistema
    
        return view('laraflex::admin.index')
            ->with('route', $route)
            ->with('hasRootRoute', $hasRootRoute)
            ->with('numberOfPages', $numberOfPages)
            ->with('numberOfUsers', $numberOfUsers)
            ->with('numberOfPosts', $numberOfPosts)
            ->with('systemRoutes', $systemRoutes);
    }
    
    private function hasRootRoute()
    {
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            if ($route->uri() === '/' && $route->getAction()['uses'] instanceof Closure) {
                return true;
            }
        }
        
        return false;
    }
    
    

    private function getSystemRoutes()
    {
        $routes = Route::getRoutes();
    
        $systemRoutes = [];
        foreach ($routes as $route) {
            $systemRoutes[] = [
                'uri' => $route->uri(),
                'action' => $route->getActionName(),
            ];
        }
    
        return $systemRoutes;
    }
    


    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            // Si el usuario ya está autenticado y es un administrador,
            // redirigirlo de vuelta a '/panel'
            if (Auth::check() && Auth::user()->role === 'admin') {
                return redirect('panel');
            }
    
            // Render the login form
            return view('laraflex::admin.login');
        }
    
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                // Verifica si el usuario es un administrador
                if (Auth::user()->role !== 'admin') {
                    Auth::logout();
                    return back()->withErrors(['error' => 'Solo los administradores pueden iniciar sesión aquí.']);
                }
                
                // Verifica si las credenciales son las predeterminadas
                if (Auth::user()->email == 'admin@admin.com' && Hash::check('adminadmin', Auth::user()->password)) {
                    session()->flash('defaultCredentials', 'You are using the default credentials. Please change them.');
                }
                
                // Autenticación exitosa, redirecciona al panel
                return redirect()->intended('/panel');
            }
            
    
            // Autenticación fallida, redirecciona de nuevo al formulario de login con un mensaje de error
            return back()->withErrors(['error' => 'Invalid Email address or Password']);
        }
    }
    
    public function ajaxSearchResults(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
    
        $pages = SitePage::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        $posts = SitePost::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

    
        $results = [
            'pages' => $pages,
            'posts' => $posts,
            // Agrega cualquier otro resultado necesario
        ];
    
        return response()->json([
            'redirectUrl' => route('panel.searchResults', ['searchTerm' => $searchTerm]),
        ]);
    }
    

    public function searchResults(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
    
        $pages = SitePage::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        $posts = SitePost::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        // Agrega cualquier otra consulta necesaria
    
        return view('laraflex::admin.search-results', [
            'pages' => $pages,
            'posts' => $posts,
            'searchTerm' => $searchTerm,
        ]);
    }
    

}