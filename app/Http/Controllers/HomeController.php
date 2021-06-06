<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 

    public function __invoke()
    {
        $bands=Band::with('album')->latest()->paginate(9);
       
        return view('home',compact('bands'));
    }
}
