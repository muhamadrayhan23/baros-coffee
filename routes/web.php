<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonyController;

// Public Routes
Route::get('/', [App\Http\Controllers\PublicPageController::class, 'home'])->name('user.home');
Route::get('/about', [App\Http\Controllers\PublicPageController::class, 'about'])->name('user.about');
Route::get('/products', [App\Http\Controllers\PublicPageController::class, 'products'])->name('user.products');
Route::get('/products/{id}', [App\Http\Controllers\PublicPageController::class, 'productDetail'])->name('user.product.detail');
Route::get('/articles', [App\Http\Controllers\PublicPageController::class, 'articles'])->name('user.articles');
Route::get('/articles/{id}', [App\Http\Controllers\PublicPageController::class, 'articleDetail'])->name('user.article.detail');
Route::get('/galeri', [App\Http\Controllers\PublicPageController::class, 'gallery'])->name('user.gallery');
Route::get('/contact', [App\Http\Controllers\PublicPageController::class, 'contact'])->name('user.contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes Group
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin content sub-menus (placeholders matching sidebar links and quick actions)
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::patch('/product/{id}/status', [ProductController::class, 'togglePublished'])->name('product.toggleStatus');

    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/add', [ArticleController::class, 'create'])->name('article.create');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/article', [ArticleController::class, 'store'])->name('article.store');
    Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/add', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/testimony', [TestimonyController::class, 'index'])->name('testimony.index');
    Route::get('/testimony/add', [TestimonyController::class, 'create'])->name('testimony.create');
    Route::get('/testimony/edit/{id}', [TestimonyController::class, 'edit'])->name('testimony.edit');

    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/add', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/banner', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/banner/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/banner/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
    Route::patch('/banner/{id}/status', [BannerController::class, 'toggleStatus'])->name('banner.toggleStatus');
});
