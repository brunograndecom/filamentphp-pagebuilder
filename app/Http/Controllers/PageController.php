<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function get($slug = 'home')
    {
        $page = Page::active()->where('slug', $slug)->firstOrFail();

        return view('page', ['page' => $page]);
    }
}
