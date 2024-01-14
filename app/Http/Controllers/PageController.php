<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
}
