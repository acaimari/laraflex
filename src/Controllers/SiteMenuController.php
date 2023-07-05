<?php

namespace Caimari\LaraFlex\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Session;

use Caimari\LaraFlex\Models\SitePost;
use Caimari\LaraFlex\Models\SitePage;
use Caimari\LaraFlex\Models\SiteMenu;
use Caimari\LaraFlex\Models\SiteMenuItem;
use Caimari\LaraFlex\Models\SitePostCategory;



class SiteMenuController extends Controller
{
public function getMenuTree($menu_id)
{
    $menuItems = SiteMenuItem::where('menu_id', $menu_id)
                    ->orderBy('parent')
                    ->orderBy('sort')
                    ->orderBy('depth')
                    ->get();
    $refs = [];
    foreach ($menuItems as $item) {
        $thisref = &$refs[$item->id];
        $thisref['parent'] = $item->parent;
        $thisref['name'] = $item->name;
        $thisref['depth'] = $item->depth;
        $thisref['children'] = [];
        $thisref['id'] = $item->id;
        $thisref['title'] = $item->title;  // Asegúrate de que el objeto $item tiene una propiedad 'title'
        $thisref['type'] = $item->type;  // Asegúrate de que el objeto $item tiene una propiedad 'type'
        $thisref['slug'] = $item->slug ?? '';  // Asegúrate de que el objeto $item tiene una propiedad 'slug'
        $thisref['target'] = $item->target ?? '';  // Asegúrate de que el objeto $item tiene una propiedad 'target'
        if ($item->parent == 0) {
            $tree[$item->id] = &$thisref;
        } else {
            $refs[$item->parent]['children'][$item->id] = &$thisref;
        }
    }
    return $tree ?? [];
}

public function index()
{
    $menuItems = [];
    $desiredMenu = null;

    if (isset($_GET['id']) && $_GET['id'] != 'new') {
        $desiredMenu = SiteMenu::find($_GET['id']);
    } else {
        $desiredMenu = SiteMenu::orderBy('id', 'DESC')->first();
    }

    if ($desiredMenu) {
        $menuItems = $this->getMenuTree($desiredMenu->id);
    }

    $categories = SitePostCategory::all();
    $posts = SitePost::all();
    $pages = SitePage::all(); 
    $menus = SiteMenu::all();

    $menuId = isset($_GET['id']) ? $_GET['id'] : null;

    return view('laraflex::admin.menus.index', compact('categories', 'posts', 'pages', 'menus', 'desiredMenu', 'menuItems', 'menuId'));
}



 public function store(Request $request)
 {
     $data = $request->all();
 
     // Validar si el título del menú está vacío
     if (empty($data['title'])) {
         return redirect()->back()->with('error', 'Menu title cannot be empty!');
     }
 
     if (SiteMenu::create($data)) {
         $newData = SiteMenu::orderBy('id', 'DESC')->first();
         return redirect()->route('panel.menus', ['id' => $newData->id])->with('success', 'Menu saved successfully!');
     } else {
         return redirect()->back()->with('error', 'Failed to save menu!');
     }
 }
 

 public function updateMenu(Request $request){
    $items = $request->input('items');
    $location = $request->input('location');
    $menuid = $request->input('menuid');

    DB::transaction(function() use ($items, $location, $menuid){
        foreach($items as $item) {
            $id = $item['id'];
            $sort = $item['sort'];
            $depth = $item['depth'];
            $parentId = array_key_exists('parentId', $item) ? $item['parentId'] : null;

            $menuItem = SiteMenuItem::find($id);
            if ($menuItem) {
                $menuItem->update([
                    'parent' => $parentId,  // Aquí hemos cambiado 'parent_id' por 'parent'
                    'sort' => $sort,
                    'depth' => $depth,
                ]);
            }
        }
        // Actualizar el valor de location en el SiteMenu correspondiente
        $menu = SiteMenu::find($menuid);
        if ($menu) {
            $menu->update(['location' => $location]);
        }
    });

    return response()->json(['success' => true]);
}



      public function destroy(Request $request)
    {
    SiteMenuItem::where('menu_id', $request->id)->delete();
    SiteMenu::findOrFail($request->id)->delete();
    return redirect()->route('panel.menus')->with('success', 'Menu deleted successfully');
        }


        public function addCatToMenu(Request $request)
        {
            $data = $request->all();
            $menuid = $request->menuid;
            $ids = $request->ids;
            $menu = SiteMenu::findOrFail($menuid);
        
            if ($menu->content == '') {
                foreach ($ids as $id) {
                    $data['title'] = SitePostCategory::where('id', $id)->value('title');
                    $data['slug'] = SitePostCategory::where('id', $id)->value('slug');
                    $data['type'] = 'category';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
            } else {
                $olddata = json_decode($menu->content, true);
        
                foreach ($ids as $id) {
                    $data['title'] = SitePostCategory::where('id', $id)->value('title');
                    $data['slug'] = SitePostCategory::where('id', $id)->value('slug');
                    $data['type'] = 'category';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
        
                foreach ($ids as $id) {
                    $array['title'] = SitePostCategory::where('id', $id)->value('title');
                    $array['slug'] = SitePostCategory::where('id', $id)->value('slug');
                    $array['name'] = NULL;
                    $array['type'] = 'category';
                    $array['target'] = NULL;
                    $array['id'] = SiteMenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->value('id');
                    $array['children'] = [[]];
                    array_push($olddata[0], $array);
                    $oldata = json_encode($olddata);
                    $menu->update(['content' => $oldata]);
                }
            }
        }
    

        public function addPageToMenu(Request $request)
        {
            $data = $request->all();
            $menuid = $request->menuid;
            $ids = $request->ids;
            $menu = SiteMenu::findOrFail($menuid);
        
            if ($menu->content == '') {
                foreach ($ids as $id) {
                    $data['title'] = SitePage::where('id', $id)->value('title');
                    $data['slug'] = SitePage::where('id', $id)->value('slug');
                    $data['type'] = 'page';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
            } else {
                $olddata = json_decode($menu->content, true);
        
                foreach ($ids as $id) {
                    $data['title'] = SitePage::where('id', $id)->value('title');
                    $data['slug'] = SitePage::where('id', $id)->value('slug');
                    $data['type'] = 'page';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
        
                foreach ($ids as $id) {
                    $array['title'] = SitePage::where('id', $id)->value('title');
                    $array['slug'] = SitePage::where('id', $id)->value('slug');
                    $array['name'] = NULL;
                    $array['type'] = 'page';
                    $array['target'] = NULL;
                    $array['id'] = SiteMenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                    $array['children'] = [[]];
                    array_push($olddata[0], $array);
                    $oldata = json_encode($olddata);
                    $menu->update(['content' => $oldata]);
                }
            }
        }
        

        public function addPostToMenu(Request $request)
        {
            $data = $request->all();
            $menuid = $request->menuid;
            $ids = $request->ids;
            $menu = SiteMenu::findOrFail($menuid);
        
            if ($menu->content == '') {
                foreach ($ids as $id) {
                    $data['title'] = SitePost::where('id', $id)->value('title');
                    $data['slug'] = SitePost::where('id', $id)->value('slug');
                    $data['type'] = 'post';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
            } else {
                $olddata = json_decode($menu->content, true);
        
                foreach ($ids as $id) {
                    $data['title'] = SitePost::where('id', $id)->value('title');
                    $data['slug'] = SitePost::where('id', $id)->value('slug');
                    $data['type'] = 'post';
                    $data['menu_id'] = $menuid;
                    $data['updated_at'] = NULL;
                    SiteMenuItem::create($data);
                }
        
                foreach ($ids as $id) {
                    $array['title'] = SitePost::where('id', $id)->value('title');
                    $array['slug'] = SitePost::where('id', $id)->value('slug');
                    $array['name'] = NULL;
                    $array['type'] = 'post';
                    $array['target'] = NULL;
                    $array['id'] = SiteMenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                    $array['children'] = [[]];
                    array_push($olddata[0], $array);
                    $oldata = json_encode($olddata);
                    $menu->update(['content' => $oldata]);
                }
            }
        }
        
        public function addCustomLink(Request $request)
{
    $data = $request->all();
    $menuid = $request->menuid;
    $menu = SiteMenu::findOrFail($menuid);

    if ($menu->content == '') {
        $data['title'] = $request->link;
        $data['slug'] = $request->url;
        $data['type'] = 'custom';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        SiteMenuItem::create($data);
    } else {
        $olddata = json_decode($menu->content, true);
        $data['title'] = $request->link;
        $data['slug'] = $request->url;
        $data['type'] = 'custom';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        SiteMenuItem::create($data);
        $array = [];
        $array['title'] = $request->link;
        $array['slug'] = $request->url;
        $array['name'] = NULL;
        $array['type'] = 'custom';
        $array['target'] = NULL;
        $array['id'] = SiteMenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
        $array['children'] = [[]];
        array_push($olddata[0], $array);
        $oldata = json_encode($olddata);
        $menu->update(['content' => $oldata]);
    }
}

    

    public function updateMenuItem(Request $request)
    {
        $data = $request->all();
        $item = SiteMenuItem::findOrFail($request->id);
        $item->update($data);
        return redirect()->back();
    }
    

// Delete Items

    public function deleteMenuItem($id)
{
    $menuitem = SiteMenuItem::findOrFail($id);
    $menu = SiteMenu::where('id', $menuitem->menu_id)->first();

    if ($menu) {
        $menuItems = $this->getMenuTree($menu->id);
        $this->deleteItemAndChildren($menuItems, $id);

        $newdata = $this->flattenMenuTree($menuItems);
        $menu->update(['content' => $newdata]);
    }

    $menuitem->delete();
    return redirect()->back();
}


private function deleteItemAndChildren(&$menuItems, $id)
{
    foreach ($menuItems as $key => &$item) {
        if ($item['id'] == $id) {
            unset($menuItems[$key]);
            return;
        }
        if (!empty($item['children'])) {
            $this->deleteItemAndChildren($item['children'], $id);
        }
    }
}

private function flattenMenuTree($menuItems)
{
    $result = [];
    foreach ($menuItems as $item) {
        $result[] = $item;
        if (!empty($item['children'])) {
            $result = array_merge($result, $this->flattenMenuTree($item['children']));
        }
    }
    return [$result];
}


// Show Menu en el frontend con retorno de datos all servideprovider

public function showMenu()
{
    // Busca el menú por su ubicación
    $menu = SiteMenu::where('location', 'nav')->first();

    // Si no se encuentra el menú, devuelve un array vacío
    if (!$menu) {
        return [];
    }

    // Busca los elementos del menú
    $menuItems = SiteMenuItem::where('menu_id', $menu->id)
        ->orderBy('sort', 'asc')  // Ordena por la columna 'sort'
        ->get();

    // Construye la estructura de árbol
    $menuTree = $this->buildMenuTree($menuItems);

    // Retorna solo los datos del menú
    return $menuTree;
}








private function buildMenuTree($menuItems, $parentId = null)
{
    $tree = [];

    foreach($menuItems as $menuItem) {
        if ($menuItem->parent == $parentId) {
            $children = $this->buildMenuTree($menuItems, $menuItem->id);

            if ($children) {
                $menuItem->children = $children;
            }

            $tree[] = $menuItem;
        }
    }

    return $tree;
}


}
