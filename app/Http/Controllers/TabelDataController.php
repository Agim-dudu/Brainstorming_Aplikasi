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
            $entity = Product::findOrFail($id);

            // Hapus file gambar terkait
            if (Storage::exists('public/images/product' . $entity->photo)) {
                Storage::delete('public/images/product' . $entity->photo);
            }

            $entity->delete();

            return redirect()->route('admin.tabel_data.index')->with('success', 'Produk berhasil dihapus!');
        } elseif ($request->has('entity') && $request->get('entity') === 'user') {
            // Pastikan bahwa pengguna yang mencoba menghapus akun adalah pengguna yang diotorisasi
            if ($id != Auth::id()) {
                return redirect()->route('login')->withErrors(['error' => 'Anda tidak diizinkan untuk menghapus akun ini.']);
            }

            // Logout pengguna sebelum dihapus
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Hapus pengguna
            User::destroy($id);

            return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
        }

        // Tambahkan logika lain jika diperlukan
        // ...

        return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus entitas.']);
    }

}
