<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
            $file = $request->file('thumbnail');
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('article');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $data['thumbnail'] = 'article/' . $name; // public/article/filename
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
            // remove old file from public folder
            if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
                File::delete(public_path($article->thumbnail));
            }

            $file = $request->file('thumbnail');
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('article');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $data['thumbnail'] = 'article/' . $name;
        }

        $article->update($data);

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
            File::delete(public_path($article->thumbnail));
        }
        $article->delete();
        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
