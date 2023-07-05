<?php

namespace Caimari\LaraFlex\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use Caimari\LaraFlex\Models\Theme;


class ThemeController extends Controller
{
    public function index()
    {
        $themes = DB::table('site_themes')->get();

        return view('laraflex::admin.themes.index', ['themes' => $themes]);
    }

    public function toggle($id)
    {
        $theme = DB::table('site_themes')->where('id', $id)->first();

        if ($theme->active == 1) {
            DB::table('site_themes')->update(['active' => 0]);
            DB::table('site_themes')->where('id', $id)->update(['active' => 0]);
        } else {
            DB::table('site_themes')->update(['active' => 0]);
            DB::table('site_themes')->where('id', $id)->update(['active' => 1]);
        }

        return redirect()->back();
    }
    public function install(Request $request)
    {
        $request->validate([
            'theme' => 'required|file|mimes:zip'
        ]);
    
        $path = $request->file('theme')->storeAs('themes', $request->file('theme')->getClientOriginalName());
        $themeName = pathinfo($request->file('theme')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('theme')->getClientOriginalExtension();
    
        $extractPath = base_path('vendor/laraflex/themes');
        $themeFolderPath = "$extractPath/$themeName";
    
        // Comprueba si ya existe un tema con el mismo nombre
        if (file_exists($themeFolderPath)) {
            return redirect()->back()->withErrors(['A theme with the same name already exists. Please delete the existing theme before installing a new one.']);
        }
    
        if ($extension === 'zip') {
            $zip = new \ZipArchive;
            $res = $zip->open(storage_path('app/' . $path));
            if ($res === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                return redirect()->back()->withErrors(['Could not open the file.']);
            }
        } else {
            return redirect()->back()->withErrors(['Invalid file format. Only zip files are accepted.']);
        }
    
        if (!file_exists("$extractPath/$themeName/composer.json")) {
            $this->deleteThemeFolder($themeFolderPath);
            return redirect()->back()->withErrors(['The uploaded file does not contain the theme folder.']);
        }
    
        $composer = json_decode(file_get_contents("$extractPath/$themeName/composer.json"));
    
        if ($composer->type == "laraflex-theme") {
            DB::table('site_themes')->insert([
                'name' => $themeName,
                'description' => $composer->description,
                'provider' => implode(", ", $composer->extra->laravel->providers),
                'active' => 0
            ]);
        } else {
            $this->deleteThemeFolder($themeFolderPath);
            return redirect()->back()->withErrors(['The uploaded file does not appear to be a Laraflex theme.']);
        }
    
        return redirect()->back()->with('success', 'Theme installed successfully.');
    }
    
    private function deleteThemeFolder($folderPath) 
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
    
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }
    
        rmdir($folderPath);
    }
    public function backup(Request $request)
{
    $themeIds = explode(',', $request->input('selected_themes'));

    // Create a new zip archive
    $zip = new \ZipArchive;

    // Generate timestamp
    $timestamp = date('YmdHis');

    $filename = storage_path('app/themes_backup.zip');
    if ($zip->open($filename, \ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    foreach ($themeIds as $themeId) {
        // Get the theme's name from the database
        $theme = DB::table('site_themes')->where('id', $themeId)->first();
        $themeName = $theme->name;

        // Add the theme's directory to the zip
        $themeDirectory = base_path("vendor/caimari/themes/$themeName");
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($themeDirectory),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($themeDirectory) + 1);

                $zip->addFile($filePath, "$themeName/$relativePath");
            }
        }
    }

    $zip->close();

    // Redirect
    return response()->download($filename, "themes_backup_$timestamp.zip");
    }

    public function destroy(Request $request, $id)
    {
        // Obtén el usuario autenticado
        $user = Auth::user();
    
        // Si no hay usuario autenticado, redirige a la página de inicio de sesión
        if ($user === null) {
            return redirect('panel');
        }
    
        // Si hay un usuario autenticado, comprueba la contraseña
        if (!Hash::check($request->get('adminPassword'), $user->password)) {
            Log::info('Admin password is incorrect.');  
            return redirect()->route('panel.themes')->with(['error' => 'The admin password is incorrect.']);
        }
        
        // Obtén el tema
        $theme = Theme::find($id);
            
        // Elimina el directorio del tema
        File::deleteDirectory(base_path('vendor/caimari/themes/' . $theme->name));
            
        // Elimina el tema de la base de datos
        $theme->delete();
            
        // Redirige al usuario
        return redirect()->route('panel.themes')->withSuccess('Theme deleted successfully.');
    }
    
    
    
    
    
    
    
}