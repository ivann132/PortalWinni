<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $data = Article::where('status', 'publish')->orderBy('id', 'desc')->paginate(5);

        return view('home', compact('data'));
    }
}
