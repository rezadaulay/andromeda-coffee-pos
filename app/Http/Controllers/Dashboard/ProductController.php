<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Remove the specified product from storage.
     */
    public function index(){
        $products = \App\Models\Product::with('category')->get();
        return view('dashboard.product.temp-list', compact('products'));
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
