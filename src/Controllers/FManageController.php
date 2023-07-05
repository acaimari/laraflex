<?php
  
namespace Caimari\LaraFlex\Controllers;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return view('laraflex::admin.fmanager.index');
    }

}