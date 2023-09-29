<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TabelDataController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $users = User::all();

        return view('tabel_data', compact('products', 'users'));
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        // Periksa jenis entitas berdasarkan parameter yang diberikan
        if ($request->has('entity') && $request->get('entity') === 'product') {
            $product = Product::findOrFail($id);

            // Hapus file gambar terkait
            if (Storage::exists('public/images/product/' . $product->photo)) {
                Storage::delete('public/images/product/' . $product->photo);
            }

            $product->delete();

            return redirect()->route('admin.tabel_data.index')->with('success', 'Produk berhasil dihapus!');
        }

        // Jika bukan produk, Anda dapat menambahkan logika lain jika diperlukan
        return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus entitas.']);
    }
}
