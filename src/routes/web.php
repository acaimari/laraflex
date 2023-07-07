<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Auth\LoginController;
use Caimari\LaraFlex\Controllers\HomeController;
use Caimari\LaraFlex\Controllers\AdminController;
use Caimari\LaraFlex\Controllers\UserController;
use Caimari\LaraFlex\Controllers\ThemeController;
use Caimari\LaraFlex\Controllers\ThemeCreateController;
use Caimari\LaraFlex\Controllers\ThemeOptionsController;
use Caimari\LaraFlex\Controllers\PagesController;
use Caimari\LaraFlex\Controllers\PostController;
use Caimari\LaraFlex\Controllers\PostCategoryController;
use Caimari\LaraFlex\Controllers\PostTagController;
use Caimari\LaraFlex\Controllers\SiteMenuController;
use Caimari\LaraFlex\Controllers\SiteContentController;
use Caimari\LaraFlex\Controllers\GeneralSettingsController;
use Caimari\LaraFlex\Controllers\SiteSearchController;
use Caimari\LaraFlex\Controllers\SiteGalleriesController;
use Caimari\LaraFlex\Controllers\FManageController;
use Caimari\LaraFlex\Controllers\TableController;

use Caimari\LaraFlex\Controllers\TestController;


////////////////////////// SYSTEM ////////////////////////////////////////////////

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

////////////////////////// ADMIN ////////////////////////////////////////////////

// Ruta de inicio de sesión sin auth
Route::match(['get', 'post'], '/panel/login', [AdminController::class, 'login'])
    ->middleware('web')
    ->name('login');

// Admin Panel // Rutas protegidas con web y auth
Route::middleware(['web', 'auth'])->prefix('panel')->group(function () {

    // Dynamic routes in crud Admin generator
    include('generated.php');

    // Test
    Route::get('test', [TestController::class, 'test'])->name('test');

    // Filemanager FManager
    Route::get('fmanager', [FManageController::class, 'index'])->name('fmanager');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');

    // Tables SQL
    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');  
    Route::get('/tables/create', [TableController::class, 'create'])->name('tables.create');
    Route::post('/tables', [TableController::class, 'store'])->name('tables.store');

    // Crud System
    Route::post('/crud/generateIndex', [TableController::class, 'generateIndex'])->name('admin.generateIndex');
    Route::post('/crud/generateCreate', [TableController::class, 'generateCreate'])->name('admin.generateCreate');
    Route::post('/crud/generateEdit', [TableController::class, 'generateEdit'])->name('admin.generateEdit');
    Route::get('/crud/deleteCrud/{table}', [TableController::class, 'deleteCrud'])->name('admin.deleteCrud');

    // General Settings
    Route::get('general-settings', [GeneralSettingsController::class, 'index'])->name('admin.general-settings.index');
    Route::get('general-settings/edit', [GeneralSettingsController::class, 'edit'])->name('admin.general-settings.edit');
    Route::put('general-settings/update', [GeneralSettingsController::class, 'update'])->name('admin.general-settings.update');
   
    // Pages
    Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PagesController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PagesController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [PagesController::class, 'update'])->name('pages.update');
    Route::post('pages/{page}/destroy', [PagesController::class, 'destroy'])->name('pages.destroy');
    Route::post('setHomePage/{id}', [GeneralSettingsController::class, 'setHomePage'])->name('setHomePage');

    // Posts
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('search', [PostController::class, 'ajaxSearch'])->name('posts.ajaxSearch');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/get-posts', [PostController::class, 'getPosts'])->name('posts.getPosts');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('posts/{id}/remove-image', [PostController::class, 'removeImage'])->name('posts.removeImage');
    Route::post('setHomePost/{id}', [GeneralSettingsController::class, 'setHomePost'])->name('setHomePost');

    // Post Categories
    Route::get('/post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
    Route::get('/post-categories/create', [PostCategoryController::class, 'create'])->name('post-categories.create');
    Route::post('/post-categories', [PostCategoryController::class, 'store'])->name('post-categories.store');
    Route::get('/post-categories/{id}/edit', [PostCategoryController::class, 'edit'])->name('post-categories.edit');
    Route::put('/post-categories/{id}', [PostCategoryController::class, 'update'])->name('post-categories.update');
    Route::delete('/post-categories/{id}', [PostCategoryController::class, 'destroy'])->name('post-categories.destroy');

    // Post Tags
    Route::get('/post-tags', [PostTagController::class, 'index'])->name('post.tags.index');
    Route::get('/post-tags/create', [PostTagController::class, 'create'])->name('post.tags.create');
    Route::post('/post-tags', [PostTagController::class, 'store'])->name('post.tags.store');
    Route::get('/post-tags/{id}/edit', [PostTagController::class, 'edit'])->name('post.tags.edit');
    Route::put('/post-tags/{id}', [PostTagController::class, 'update'])->name('post.tags.update');
    Route::delete('/post-tags/{id}', [PostTagController::class, 'destroy'])->name('post.tags.destroy');
    
    // Galleries    
    Route::get('/galleries', [SiteGalleriesController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [SiteGalleriesController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [SiteGalleriesController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/{id}/edit', [SiteGalleriesController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{id}', [SiteGalleriesController::class, 'update'])->name('galleries.update');
    Route::delete('/galleries/{id}', [SiteGalleriesController::class, 'destroy'])->name('galleries.destroy');
    
    // Themes
    Route::get('/themes', [ThemeController::class, 'index'])->name('panel.themes');
    Route::patch('/themes/toggle/{id}', [ThemeController::class, 'toggle'])->name('panel.themes.toggle');
    Route::post('/themes/install', [ThemeController::class, 'install'])->name('panel.themes.install');
    Route::post('/themes/backup', [ThemeController::class, 'backup'])->name('panel.themes.backup');
    Route::delete('/themes/{id}', [ThemeController::class, 'destroy'])->name('panel.themes.destroy');
    
    // Theme Options
    Route::get('/theme-options', [ThemeOptionsController::class, 'index'])->name('theme.options');
    Route::post('/theme-options', [ThemeOptionsController::class, 'update'])->name('theme.options.update');

    // Theme Create
    Route::get('/theme/create', [ThemeCreateController::class, 'index'])->name('theme.create');
    Route::post('/theme/process', [ThemeCreateController::class, 'process'])->name('theme.process');
    Route::get('/theme/index', [ThemeCreateController::class, 'index'])->name('theme.index');


    // Menus
    Route::get('manage-menus/{id?}', [SiteMenuController::class, 'index'])->name('panel.menus');
    Route::post('create-menu', [SiteMenuController::class, 'store'])->name('create.menu');
    Route::get('update-menu', [SiteMenuController::class, 'updateMenu'])->name('update.menu');
    Route::get('delete-menu/{id}', [SiteMenuController::class, 'destroy'])->name('delete.menu');

    Route::get('add-categories-to-menu', [SiteMenuController::class, 'addCatToMenu'])->name('add.categories.menu');
    Route::get('add-post-to-menu', [SiteMenuController::class, 'addPostToMenu'])->name('add.post.menu');
    Route::get('add-page-to-menu', [SiteMenuController::class, 'addPageToMenu'])->name('add.page.menu');
    Route::get('add-custom-link', [SiteMenuController::class, 'addCustomLink'])->name('add.custom.link.menu');

    Route::post('update-menuitem/{id}', [SiteMenuController::class, 'updateMenuItem'])->name('update.menuitem');
    Route::get('delete-menuitem/{id}', [SiteMenuController::class, 'deleteMenuItem'])->name('delete.menuitem');

    Route::get('/', [AdminController::class, 'index'])->name('panel.index');
    Route::post('ajax-search-results', [AdminController::class, 'ajaxSearchResults'])->name('panel.ajaxSearchResults');
    Route::get('search-results', [AdminController::class, 'searchResults'])->name('panel.searchResults');
  
  
  Route::get('/logout', function () {
        Auth::logout();
        return redirect('panel/login');
    })->name('panel.logout');
});

////////////////////////// GLOBAL FRONT ////////////////////////////////////////////////

// Search
Route::get('search', [SiteSearchController::class, 'search'])->name('search');

// Posts
Route::get('p/{slug}', [SiteContentController::class, 'showPost'])->name('post.show');
Route::get('p', [SiteContentController::class, 'listPosts'])->name('post.list');

// Post Categories
Route::get('c/{slug}', [SiteContentController::class, 'showCategory'])->name('category.show');
Route::get('c', [SiteContentController::class, 'listCategories'])->name('category.list');

// Post Tags
Route::get('t/{slug}', [SiteContentController::class, 'showTag'])->name('tag.show');
Route::get('t', [SiteContentController::class, 'listTags'])->name('tag.list');

// Pages /// IMPORTANTE!!! el Route::get('{slug}' tiene que ser el ultimo de la lista para no sobreescribir rutas
Route::get('pg', [SiteContentController::class, 'ListPages'])->name('page.list');
Route::get('pg/{slug}', [SiteContentController::class, 'showPage'])->name('page.show');