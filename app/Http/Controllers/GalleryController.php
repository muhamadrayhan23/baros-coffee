<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(5);

        return view('admin.gallery.gallery', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'caption.required' => 'Keterangan foto wajib diisi.',
            'foto.required' => 'Foto galeri wajib diunggah.',
            'foto.image' => 'Foto galeri harus berupa file gambar.',
            'foto.mimes' => 'Foto galeri harus berformat jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran foto galeri maksimal 5MB.',
        ]);

        $gallery = new Gallery();
        $gallery->caption = $request->caption;

        if ($request->hasFile('foto')) {
            File::ensureDirectoryExists(public_path('gallery'));
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gallery'), $filename);
            $gallery->foto = $filename;
        }

        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'caption' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'caption.required' => 'Keterangan foto wajib diisi.',
            'foto.image' => 'Foto galeri harus berupa file gambar.',
            'foto.mimes' => 'Foto galeri harus berformat jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran foto galeri maksimal 5MB.',
        ]);

        $gallery->caption = $request->caption;

        if ($request->hasFile('foto')) {
            if ($gallery->foto && File::exists(public_path('gallery/' . $gallery->foto))) {
                File::delete(public_path('gallery/' . $gallery->foto));
            }

            File::ensureDirectoryExists(public_path('gallery'));
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gallery'), $filename);
            $gallery->foto = $filename;
        }

        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->foto && File::exists(public_path('gallery/' . $gallery->foto))) {
            File::delete(public_path('gallery/' . $gallery->foto));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
