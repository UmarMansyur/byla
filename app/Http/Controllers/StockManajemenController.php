<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StockManajemenController extends Controller
{
    public function index(Request $request)
    {
        $existMerchant = Merchant::where('user_id', Auth::user()->id)->first();

        if(!$existMerchant) {
            return redirect()->route('Store Page')->with('error', 'Anda belum memiliki toko, silahkan aktifkan toko terlebih dahulu');
        }

        if($existMerchant->is_verified == 0){
            return redirect()->route('Store Page')->with('error', 'Toko anda belum dikonfirmasi, silahkan tunggu konfirmasi dari admin untuk mengelola stok produk!');
        }

        if($request->search) {
            $products = Product::where('title', 'like', '%'.$request->search.'%')->paginate(5);
        } else {
            $products = Product::where('merchant_id', $existMerchant->id)->paginate(5);
        }

        
        return view('pengguna.stock.index', compact('products'));
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'stock' => 'required|numeric|min:1',
                'id' => 'required|exists:products,id'
            ]);
            $product = Product::find($request->id);
            $product->stock = $request->query('stock');
            $product->save();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false]);
        }
    }
}
