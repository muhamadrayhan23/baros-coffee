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
        // 1. Fetch counts from DB
        $totalProducts = Product::count();
        $totalArticles = Article::count();
        $totalGalleries = Gallery::count();
        $totalTestimonies = Testimony::count();
        $totalUsers = User::count();

        // 2. Fetch lists from DB
        $products = Product::latest()->take(5)->get();
        $articles = Article::latest()->take(5)->get();

        // 3. Fallback to dummy data if database is empty
        if ($products->isEmpty()) {
            $products = collect([
                (object)[
                    'id' => 1,
                    'nama_produk' => 'Espresso Baros Blend',
                    'harga' => 35000,
                    'berat' => '250g',
                    'gambar' => null,
                    'created_at' => now()->subDays(1),
                ],
                (object)[
                    'id' => 2,
                    'nama_produk' => 'Single Origin Arabica Gayo',
                    'harga' => 45000,
                    'berat' => '250g',
                    'gambar' => null,
                    'created_at' => now()->subDays(2),
                ],
                (object)[
                    'id' => 3,
                    'nama_produk' => 'Robusta Temanggung Premium',
                    'harga' => 30000,
                    'berat' => '500g',
                    'gambar' => null,
                    'created_at' => now()->subDays(3),
                ],
                (object)[
                    'id' => 4,
                    'nama_produk' => 'Liberica Honey Process',
                    'harga' => 50000,
                    'berat' => '200g',
                    'gambar' => null,
                    'created_at' => now()->subDays(4),
                ],
                (object)[
                    'id' => 5,
                    'nama_produk' => 'House Blend Gayo Robusta',
                    'harga' => 38000,
                    'berat' => '250g',
                    'gambar' => null,
                    'created_at' => now()->subDays(5),
                ],
            ]);
            $totalProducts = 5;
        }

        if ($articles->isEmpty()) {
            $articles = collect([
                (object)[
                    'id' => 1,
                    'judul' => 'Mengenal Proses Honey pada Kopi Pasca Panen',
                    'thumbnail' => null,
                    'isi' => 'Proses honey adalah salah satu metode pengolahan pasca panen kopi...',
                    'created_at' => now()->subDays(1),
                ],
                (object)[
                    'id' => 2,
                    'judul' => 'Perbedaan Arabika dan Robusta yang Wajib Diketahui',
                    'thumbnail' => null,
                    'isi' => 'Arabika dan Robusta merupakan dua jenis kopi yang paling populer...',
                    'created_at' => now()->subDays(3),
                ],
                (object)[
                    'id' => 3,
                    'judul' => 'Cara Menyeduh Kopi V60 di Rumah Seperti Barista',
                    'thumbnail' => null,
                    'isi' => 'Metode pour over V60 sangat digemari karena menghasilkan rasa kopi yang clean...',
                    'created_at' => now()->subDays(5),
                ],
                (object)[
                    'id' => 4,
                    'judul' => 'Manfaat Minum Kopi Hitam Tanpa Gula bagi Kesehatan',
                    'thumbnail' => null,
                    'isi' => 'Kopi hitam tanpa gula kaya akan antioksidan dan memiliki berbagai manfaat...',
                    'created_at' => now()->subDays(7),
                ],
                (object)[
                    'id' => 5,
                    'judul' => 'Sejarah Perkembangan Kedai Kopi di Indonesia',
                    'thumbnail' => null,
                    'isi' => 'Kedai kopi di Indonesia telah bertransformasi dari sekadar warung kopi tradisional...',
                    'created_at' => now()->subDays(10),
                ],
            ]);
            $totalArticles = 5;
        }


        // Adjust counts for demo purposes if empty
        if ($totalGalleries == 0) {
            $totalGalleries = 12;
        }
        if ($totalTestimonies == 0) {
            $totalTestimonies = 8;
        }
        if ($totalUsers <= 1) { // 1 means only Rayhan (the admin)
            $totalUsers = 15; // Set dummy count for users
        }

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
