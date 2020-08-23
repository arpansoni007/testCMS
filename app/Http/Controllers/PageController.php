<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke($page)
    {  
       $title = $page ?? config('app.name','Laravel');
       return view('home',['title',$title]);
    }
}
