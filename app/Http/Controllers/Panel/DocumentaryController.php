<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class DocumentaryController extends Controller
{
      public function List(Request $request)
    {

        $documentary = Post::where('type', 'documentary')->latest()->get();
        return view('Panel.Documentary.List', compact(['series']));
    }

}
