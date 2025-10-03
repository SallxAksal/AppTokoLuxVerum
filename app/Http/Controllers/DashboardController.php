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

    // Method untuk menampilkan halaman manajemen banner
    public function banners()
    {
        $banners = \App\Models\Banner::all();
        return view('banner-management', compact('banners'));
    }

    // Method untuk menyimpan banner baru
    public function storeBanner(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('banners', 'public');

        \App\Models\Banner::create([
            'image_path' => $path,
        ]);

        return redirect()->route('banners')->with('success', 'Banner berhasil ditambahkan.');
    }

    // Method untuk menampilkan halaman preview banner untuk crop
    public function previewBanner(Request $request)
    {
        if (!$request->hasFile('image')) {
            return redirect()->route('banners')->withErrors('File gambar tidak ditemukan.');
        }

        $image = $request->file('image');
        $imageData = base64_encode(file_get_contents($image->getRealPath()));
        $imageType = $image->getClientMimeType();

        return view('banner-preview', [
            'imageData' => $imageData,
            'imageType' => $imageType,
        ]);
    }

    // Method untuk menerima gambar hasil crop dan menyimpannya
    public function cropBanner(Request $request)
    {
        $request->validate([
            'cropped_image' => 'required|string',
        ]);

        $croppedImageData = $request->input('cropped_image');

        // Extract base64 data
        list($type, $croppedImageData) = explode(';', $croppedImageData);
        list(, $croppedImageData) = explode(',', $croppedImageData);

        $croppedImageData = base64_decode($croppedImageData);

        $fileName = 'banners/cropped_' . time() . '.png';
        \Storage::disk('public')->put($fileName, $croppedImageData);

        \App\Models\Banner::create([
            'image_path' => $fileName,
        ]);

        return redirect()->route('banners')->with('success', 'Banner berhasil ditambahkan setelah crop.');
    }

    // Method untuk menghapus banner
    public function destroyBanner($id)
    {
        $banner = \App\Models\Banner::findOrFail($id);

        // Hapus file gambar dari storage
        if ($banner->image_path && \Storage::disk('public')->exists($banner->image_path)) {
            \Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('banners')->with('success', 'Banner berhasil dihapus.');
    }
}
