<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(8);

        return view('admin.banner.banner', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_banner' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp',
            'published' => 'nullable|boolean',
        ], [
            'nama_banner.required' => 'Nama banner wajib diisi.',
            'gambar.required' => 'Gambar banner wajib diunggah.',
            'gambar.image' => 'Gambar banner harus berupa file gambar.',
            'gambar.mimes' => 'Gambar banner harus berformat jpg, jpeg, png, atau webp.',
        ]);

        $banner = new Banner();
        $banner->nama_banner = $request->nama_banner;
        $banner->published = $request->boolean('published', false);

        if ($request->hasFile('gambar')) {
            File::ensureDirectoryExists(public_path('banner'));
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('banner'), $filename);
            $banner->gambar = $filename;
        }

        $banner->save();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'nama_banner' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'published' => 'nullable|boolean',
        ], [
            'nama_banner.required' => 'Nama banner wajib diisi.',
            'gambar.image' => 'Gambar banner harus berupa file gambar.',
            'gambar.mimes' => 'Gambar banner harus berformat jpg, jpeg, png, atau webp.',
        ]);

        $banner->nama_banner = $request->nama_banner;
        $banner->published = $request->has('published');

        if ($request->hasFile('gambar')) {
            if ($banner->gambar && File::exists(public_path('banner/' . $banner->gambar))) {
                File::delete(public_path('banner/' . $banner->gambar));
            }

            File::ensureDirectoryExists(public_path('banner'));
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('banner'), $filename);
            $banner->gambar = $filename;
        }

        $banner->save();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->gambar && File::exists(public_path('banner/' . $banner->gambar))) {
            File::delete(public_path('banner/' . $banner->gambar));
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->published = ! $banner->published;
        $banner->save();

        $status = $banner->published ? 'Published' : 'Unpublished';

        return redirect()->route('admin.banner.index')->with('success', "Status banner diubah menjadi {$status}.");
    }
}
