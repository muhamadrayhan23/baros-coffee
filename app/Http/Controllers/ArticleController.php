<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5);

        return view('admin.article.article', compact('articles'));
    }

    public function create()
    {
        return view('admin.article.add');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.article.edit', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'thumbnail.required' => 'Thumbnail artikel wajib diunggah.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Upload thumbnail langsung ke folder 'articles' di Supabase Storage
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'supabase');
        }

        Article::create($data);

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama dari Supabase Storage jika ada
            if ($article->thumbnail && Storage::disk('supabase')->exists($article->thumbnail)) {
                Storage::disk('supabase')->delete($article->thumbnail);
            }

            // Upload thumbnail baru ke Supabase Storage
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'supabase');
        }

        $article->update($data);

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Hapus thumbnail dari Supabase Storage saat artikel dihapus
        if ($article->thumbnail && Storage::disk('supabase')->exists($article->thumbnail)) {
            Storage::disk('supabase')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
