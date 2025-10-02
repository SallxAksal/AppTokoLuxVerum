<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Visitor;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware handled in routes
    }

    public function index()
    {
        // Produk terbaru 5 data
        $latestProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        // Jumlah pengunjung total
        $visitorCount = Visitor::count();

        // Jumlah pengunjung online (misal, pengunjung yang aktif dalam 5 menit terakhir)
        $onlineVisitorCount = Visitor::where('visited_at', '>=', now()->subMinutes(5))->count();

        // Rating produk: hitung jumlah rating dan rata-rata rating per produk
        $productRatings = Rating::select('product_id', DB::raw('count(*) as total_ratings'), DB::raw('avg(rating) as average_rating'))
            ->groupBy('product_id')
            ->get();

        // Gabungkan data produk dengan rating
        $productsWithRatings = $latestProducts->map(function ($product) use ($productRatings) {
            $rating = $productRatings->firstWhere('product_id', $product->id);
            $product->total_ratings = $rating ? $rating->total_ratings : 0;
            $product->average_rating = $rating ? round($rating->average_rating, 2) : 0;
            return $product;
        });

        return view('dashboard', [
            'latestProducts' => $productsWithRatings,
            'visitorCount' => $visitorCount,
            'onlineVisitorCount' => $onlineVisitorCount,
        ]);
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

    public function rateProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = new Rating();
        $rating->product_id = $request->input('product_id');
        $rating->rating = $request->input('rating');
        $rating->save();

        return response()->json(['message' => 'Rating berhasil dikirim.']);
    }
}
