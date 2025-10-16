<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogDetailController extends Controller
{
    public function detail($slug)
    {
        // echo ("$slug");

        $data = Article::where('slug', $slug)->first();
        // $data = Post::where('status', 'publish')->where('slug', $slug)->firstOrFail();

        $pagination = $this->pagination($data->id);

        return view('detail', compact('data', 'pagination'));
    }

    private function pagination($id)
    {
        $dataPrev = Article::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $dataNext = Article::where('id', '>', $id)->orderBy('id', 'desc')->first();

        $data = [
            'prev' => $dataPrev,
            'next' => $dataNext
        ];

        return $data;
    }
}
