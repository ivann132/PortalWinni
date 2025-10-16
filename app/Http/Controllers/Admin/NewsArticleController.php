<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class NewsArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = Article::all();
        // $article = Article::latest()->paginate(10);
        // return view('article.article', compact('article'));
        $user = Auth::user();
        $search = $request->search;

        $data = Article::where(function ($query) use ($search) {
            if ($search) {
                $query->where('title', 'like', "%{$search}%")->orWhere('content', 'like', "%{$search}%");
            }
        })->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'string',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['title']); // Handled by model boot method now

        // if ($request->hasFile('image')) {
        //     $path = $request->file('image')->store('public/news_images');
        //     $data['image_path'] = Storage::url($path); // Store URL accessible path
        // }

        // If slug is empty, let model generate it, otherwise use provided
        // if (empty($data['slug'])) {
        //     unset($data['slug']);
        // }

        // $data['is_published'] = $request->has('is_published'); // Convert checkbox value

        Article::create($data);

        return redirect()->route('news.index')->with('success', 'News article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // return view('article.article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'published_at' => 'nullable|date',
            // 'is_published' => 'boolean',
            'slug' => 'nullable|string|unique:articles,slug,' . $article->id, // Allow current slug
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            // Optionally delete old image
            if ($article->image_path) {
                $oldImagePath = str_replace(Storage::url(''), '', $article->image_path); // Get storage relative path
                Storage::delete('public/' . $oldImagePath);
            }
            $path = $request->file('image')->store('public/news_images');
            $data['image_path'] = Storage::url($path);
        }

        $data['is_published'] = $request->has('is_published');

        // If slug is empty, let model generate it, otherwise use provided
        if (empty($data['slug'])) {
            unset($data['slug']); // Remove if empty to let model handle it on title change
        }


        $article->update($data);

        return redirect()->route('news.index')->with('success', 'News article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image_path) {
            $oldImagePath = str_replace(Storage::url(''), '', $article->image_path);
            Storage::delete('public/' . $oldImagePath);
        }
        $article->delete();
        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}
