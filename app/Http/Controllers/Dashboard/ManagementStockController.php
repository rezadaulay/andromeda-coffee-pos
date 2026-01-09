<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockLog;

class ManagementStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productId = $request->query('product_id');
        
        if ($productId) {
            $products = Product::where('id', $productId)->paginate(10);
        } else {
            $products = Product::paginate(10);
        }
        
        return view("dashboard.management-stock.index", compact('products', 'productId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view("dashboard.management-stock.edit", compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required|in:increment,decrement',
            'amount' => 'required|integer|min:0',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $amount = $request->amount;
        $type = $request->type;

        // Hitung stok baru berdasarkan jenis perubahan
        if ($type === 'increment') {
            $newQuantity = $product->quantity + $amount;
        } else {
            // decrement
            $newQuantity = $product->quantity - $amount;
            
            // Validasi agar stok tidak kurang dari 0
            if ($newQuantity < 0) {
                return back()->withErrors(['amount' => 'Jumlah pengurangan melebihi stok yang tersedia.']);
            }
        }

        $product->update(['quantity' => $newQuantity]);

        // Catat di StockLog
        StockLog::create([
            'product_id' => $product->id,
            'type' => $type,
            'amount' => $amount,
            'note' => $request->note ?? null,
        ]);

        return redirect()->route('management-stock.index', ['product_id' => $product->id])->with('success', 'Stok produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
