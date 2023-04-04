<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class FrontEndController extends Controller
{
    public function index()
    {
        $news = News::all();
        $nav_category = Category::all();

        return view('frontend.index', compact('news', 'nav_category'));
    }

    public function detailCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $news     = News::where('category_id',$category->id)->paginate(10);
        $nav_category = Category::all();

        return view('frontend.detail-category', compact('news','nav_category'));

    }

    public function detailNews($slug)
    {
        $news = News::where('slug', $slug)->first();

        return view('frontend.detail-news', compact('news'));
    }

}
