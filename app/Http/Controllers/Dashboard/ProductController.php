<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
 bintang-work
use Illuminate\Http\Request;
use App\Models\Product;
use \App\Models\ProductCategory;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
 develop

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(20);
 bintang-work
        return view("dashboard.product.index",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = ProductCategory::all();
         return view("dashboard.product.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
     'name' => 'required',
     'price' => 'required',
     'product_category_id' => 'required|exists:product_categories,id',
    ]);

    Product::create([
     "name" => $request->name,
     "price" => $request->price,
     "product_category_id" => $request->product_category_id,
    ]);

    return back()->with('success',"Produk berhasil ditambah");
       

        return view('dashboard.products.index', compact('products'));
develop
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
bintang-work
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $product = Product::with('category')->findOrFail($id);
        return view('dashboard.products.show', compact('product'));
develop
    }
}
