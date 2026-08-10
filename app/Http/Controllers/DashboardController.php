<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Testimony;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // 1. Fetch real counts from DB
        $totalProducts = Product::count();
        $totalArticles = Article::count();
        $totalGalleries = Gallery::count();
        $totalTestimonies = Testimony::count();
        $totalUsers = User::count();

        // 2. Fetch latest 5 items directly from DB
        $products = Product::latest()->take(5)->get();
        $articles = Article::latest()->take(5)->get();

        return view('admin.dashboard.dashboard', compact(
            'totalProducts',
            'totalArticles',
            'totalGalleries',
            'totalTestimonies',
            'totalUsers',
            'products',
            'articles'
        ));
    }
}
