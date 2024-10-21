<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $existMerchant = Merchant::where('user_id', Auth::user()->id)->first();
        if (!$existMerchant) {
            return redirect()->route('Store Page')->with('error', 'Anda belum memiliki toko, silahkan aktifkan toko terlebih dahulu');
        }

        if($existMerchant->is_verified == 0){
            return redirect()->route('Store Page')->with('error', 'Toko anda belum dikonfirmasi, silahkan tunggu konfirmasi dari admin untuk menambahkan produk!');
        }
        
        $total_product = Product::where('merchant_id', Auth::user()->merchant->id)->count();
        $total_asset = Product::where('merchant_id', Auth::user()->merchant->id)->sum('sale_price');
        $products = Product::where('merchant_id', Auth::user()->merchant->id);
        $total_profit = 12;
        if($request->has('search')){
            $products = $products->where('title', 'like', '%' . $request->search . '%')->paginate(5);
        } else {
            $products = $products->paginate(5);
        }
        return view('pengguna.product.index', compact('total_product', 'total_asset', 'total_profit', 'products'));
    }

    public function add_page()
    {
        return view('pengguna.product.add');
    }

    public function add(Request $request)
    {
        $imageName = null;
        try {
            $data = $request->all();
            $data = $request->only([
                'kode_produk',
                'title',
                'description',
                'price',
                'sale_price',
                'stock'
            ]);
            
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put('product/' . $imageName, file_get_contents($image));
                $data['thumbnail'] = env('APP_URL') . '/storage/product/' . $imageName;
            }

            $data['merchant_id'] = Auth::user()->merchant->id;
            $data['price'] = str_replace('.', '', $data['price']);
            $data['sale_price'] = str_replace('.', '', $data['sale_price']);
            $data['stock'] = str_replace('.', '', $data['stock']);
            Product::create($data);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            if (Storage::disk('public')->exists('product/' . $imageName)) {
                Storage::disk('public')->delete('product/' . $imageName);
            }
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit_page($id)
    {
        $produk = Product::find($id);
        if (!$produk) {
            return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
        }
        if ($produk->merchant_id != Auth::user()->merchant->id) {
            return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
        }
        return view('pengguna.product.add', compact('produk'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $produk = Product::find($id);
            if (!$produk) {
                return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
            }
            if ($produk->merchant_id != Auth::user()->merchant->id) {
                return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
            }

            $data = $request->all();

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put('product/' . $imageName, file_get_contents($image));
                $data['thumbnail'] = env('APP_URL') . '/storage/product/' . $imageName;

                if ($produk->thumbnail) {
                    if (Storage::disk('public')->exists('product/' . $produk->thumbnail)) {
                        Storage::disk('public')->delete('product/' . $produk->thumbnail);
                    }
                }
            }

            $data['price'] = str_replace('.', '', $data['price']);
            $data['sale_price'] = str_replace('.', '', $data['sale_price']);
            $data['stock'] = str_replace('.', '', $data['stock']);

            $produk->update($data);
            return redirect()->back()->with('success', 'Produk berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $produk = Product::find($id);
            if (!$produk) {
                return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
            }
            if ($produk->merchant_id != Auth::user()->merchant->id) {
                return redirect()->route('Product Page')->with('error', 'Produk tidak ditemukan');
            }
            if ($produk->thumbnail) {
                if (Storage::disk('public')->exists('product/' . $produk->thumbnail)) {
                    Storage::disk('public')->delete('product/' . $produk->thumbnail);
                }
            }
            $produk->delete();
            return redirect()->route('Product Page')->with('success', 'Produk berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
