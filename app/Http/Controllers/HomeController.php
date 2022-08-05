<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.vue');
    }
    public function indexCheck(Request $request)
    {
        if( $request->is('admin/*') )
        {
            abort('404');
        }
        return view('site.vue');
    }
}
