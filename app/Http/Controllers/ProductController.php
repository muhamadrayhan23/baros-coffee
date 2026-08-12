<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk.
     */
    public function index()
    {
        $products = Product::latest()->paginate(8);

        return view('admin.product.product', compact('products'));
    }

    /**
     * Tampilkan form tambah produk.
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'berat'       => 'required|numeric|min:0',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'   => 'required|string',
            'published'   => 'nullable|boolean',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required'       => 'Harga produk wajib diisi.',
            'harga.numeric'        => 'Harga produk harus berupa angka.',
            'berat.required'       => 'Berat produk wajib diisi.',
            'berat.numeric'        => 'Berat produk harus berupa angka.',
            'gambar.required'      => 'Gambar produk wajib diunggah.',
            'gambar.image'         => 'Gambar produk harus berupa file gambar.',
            'gambar.mimes'         => 'Gambar produk harus berformat jpeg, png, jpg, atau webp.',
            'gambar.max'           => 'Ukuran gambar produk maksimal 2MB.',
            'deskripsi.required'   => 'Deskripsi produk wajib diisi.',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            // Upload gambar langsung ke folder 'products' di Supabase Storage
            $imagePath = $request->file('gambar')->store('products', 'supabase');
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'berat'       => $request->berat,
            'gambar'      => $imagePath,
            'deskripsi'   => $request->deskripsi,
            'published'   => $request->has('published') ? true : false,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update data produk.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'berat'       => 'required|numeric|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'   => 'nullable|string',
            'published'   => 'nullable|boolean',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required'       => 'Harga produk wajib diisi.',
            'harga.numeric'        => 'Harga produk harus berupa angka.',
            'berat.required'       => 'Berat produk wajib diisi.',
            'berat.numeric'        => 'Berat produk harus berupa angka.',
            'gambar.image'         => 'Gambar produk harus berupa file gambar.',
            'gambar.mimes'         => 'Gambar produk harus berformat jpeg, png, jpg, atau webp.',
            'gambar.max'           => 'Ukuran gambar produk maksimal 2MB.',
        ]);

        $imagePath = $product->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari Supabase jika ada
            if ($product->gambar && Storage::disk('supabase')->exists($product->gambar)) {
                Storage::disk('supabase')->delete($product->gambar);
            }

            // Upload gambar baru ke Supabase Storage
            $imagePath = $request->file('gambar')->store('products', 'supabase');
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'berat'       => $request->berat,
            'gambar'      => $imagePath,
            'deskripsi'   => $request->deskripsi,
            'published'   => $request->has('published') ? true : false,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk dari database beserta gambarnya.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar dari Supabase Storage saat data dihapus
        if ($product->gambar && Storage::disk('supabase')->exists($product->gambar)) {
            Storage::disk('supabase')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Toggle cepat status published/unpublished.
     */
    public function togglePublished($id)
    {
        $product = Product::findOrFail($id);
        $product->published = ! $product->published;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Status publikasi produk berhasil diubah!');
    }
}
