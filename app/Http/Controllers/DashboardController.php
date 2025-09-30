<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware handled in routes
    }

    public function index()
    {
        // Dashboard simplified to show date/time only
        return view('dashboard');
    }

    public function list()
    {
        $products = Product::all();
        return view('product-list', compact('products'));
    }

    public function create()
    {
        return view('product-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
            'link_shopee' => 'nullable|url',
            'link_tiktok_shop' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'tipe', 'ukuran', 'harga', 'gambar', 'deskripsi', 'link_shopee', 'link_tiktok_shop']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product-edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
            'link_shopee' => 'nullable|url',
            'link_tiktok_shop' => 'nullable|url',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['nama', 'tipe', 'ukuran', 'harga', 'gambar', 'deskripsi', 'link_shopee', 'link_tiktok_shop']);
        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }
}
