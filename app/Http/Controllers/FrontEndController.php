<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class FrontEndController extends Controller
{
    public function index()
    {
        $nav_category = Category::all();
        // $news     = News::orderBy('created_at', 'desc')->paginate(10);
        $news     = News::latest()->paginate('3');
        $inRandom = News::inRandomOrder()->limit(4)->get();

        return view('frontend.parent', compact('nav_category', 'news', 'inRandom'));
    }

    public function detailCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $news     = News::where('category_id',$category->id)->paginate(10);

        return view('frontend.detail-category', compact('news'));

    }

    public function detailNews($slug)
    {
        $news = News::where('slug', $slug)->first();

        return view('frontend.detail-news', compact('news'));
    }

}
