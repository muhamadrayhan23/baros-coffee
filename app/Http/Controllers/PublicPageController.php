<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function home()
    {
        $products = Product::where('published', true)->latest()->take(4)->get();
        $articles = Article::latest()->take(4)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $testimonies = Testimony::latest()->take(4)->get();
        $banners = Banner::where('published', true)->latest()->get();

        return view('user.home', compact('products', 'articles', 'galleries', 'testimonies', 'banners'));
    }

    public function about()
    {
        return view('user.about');
    }

    public function products()
    {
        $products = Product::where('published', true)->latest()->paginate(8);

        return view('user.product', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::where('published', true)->findOrFail($id);
        $relatedProducts = Product::where('published', true)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(6)
            ->get();

        return view('user.detproduct', compact('product', 'relatedProducts'));
    }

    public function articles()
    {
        $articles = Article::latest()->get();

        return view('user.article', compact('articles'));
    }

    public function articleDetail($id)
    {
        $article = Article::findOrFail($id);
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(6)
            ->get();

        return view('user.detarticle', compact('article', 'relatedArticles'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(9);

        return view('user.gallery', compact('galleries'));
    }

    public function contact()
    {
        return view('user.contact');
    }
}
