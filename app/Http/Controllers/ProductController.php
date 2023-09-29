<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('products', $data);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "photo" => $product->photo,
                "price" => $product->price,
                "quantity" => 1
            ];
        }


        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk telah ditambahkan ke keranjang');
    }

    public function cart()
    {
        return view('cart');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed');
        }
    }

    public function create()
    {
        return view('tambah_data');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/images/product');
            $data['photo'] = basename($path);
        }

        Product::create($data);

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('update_product', compact('products'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        // Update file gambar jika diunggah
        if ($request->hasFile('photo')) {
            
            // Hapus file gambar lama dari penyimpanan (storage)
            Storage::delete('public/images/product/' . $product->photo);

            // Simpan file gambar baru
            $path = $request->file('photo')->store('public/images/product');
            $data['photo'] = basename($path);
        }

        // Update data di database
        $product->update($data);

        return redirect()->route('admin.tabel_data.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar terkait
        if (Storage::exists('public/images/product/' . $product->photo)) {
            Storage::delete('public/images/product/' . $product->photo);
        }

        $product->delete();

        return redirect()->route('admin.tabel_data.index')->with('success', 'Produk berhasil dihapus!');
    }
}
