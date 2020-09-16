<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function SiteSharing() 
    {
        dd(request()->data);
    }
}
