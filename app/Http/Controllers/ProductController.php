<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga produk harus berupa angka.',
            'berat.required' => 'Berat produk wajib diisi.',
            'berat.numeric' => 'Berat produk harus berupa angka.',
            'gambar.required' => 'Gambar produk wajib diunggah.',
            'gambar.image' => 'Gambar produk harus berupa file gambar.',
            'gambar.mimes' => 'Gambar produk harus berformat jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar produk maksimal 2MB.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
        ]);

        $imageName = null;
        if ($request->hasFile('gambar')) {
            File::ensureDirectoryExists(public_path('product'));
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product'), $imageName);
        }

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'berat'       => $request->berat,
            'gambar'      => $imageName,
            'deskripsi'   => $request->deskripsi,
            // Jika checkbox di-centang bernilai true, jika tidak di-centang bernilai false
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
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga produk harus berupa angka.',
            'berat.required' => 'Berat produk wajib diisi.',
            'berat.numeric' => 'Berat produk harus berupa angka.',
            'gambar.image' => 'Gambar produk harus berupa file gambar.',
            'gambar.mimes' => 'Gambar produk harus berformat jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar produk maksimal 2MB.',
        ]);

        $imageName = $product->gambar;

        if ($request->hasFile('gambar')) {
            if ($product->gambar && File::exists(public_path('product/' . $product->gambar))) {
                File::delete(public_path('product/' . $product->gambar));
            }

            File::ensureDirectoryExists(public_path('product'));
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product'), $imageName);
        }

        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'berat'       => $request->berat,
            'gambar'      => $imageName,
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

        if ($product->gambar && File::exists(public_path('product/' . $product->gambar))) {
            File::delete(public_path('product/' . $product->gambar));
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
        $product->published = !$product->published;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Status publikasi produk berhasil diubah!');
    }
}
