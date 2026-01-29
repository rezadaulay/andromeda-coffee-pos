<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\DetailSale;
use App\Enums\SaleStatus;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentMethod;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $paymentMethods = PaymentMethod::orderBy('name')->get();
        return view('dashboard.selling.index', compact('products', 'paymentMethods'));
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
        try {
            $data = $request->validate([
                'cart_data' => ['required','string'],
                'payment_method' => ['nullable','integer','exists:payment_methods,id'],
            ]);

            $items = json_decode($data['cart_data'], true);
            if(!is_array($items) || count($items) === 0){
                if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                    return response()->json(['error' => 'Keranjang kosong.'], 422);
                }
                return back()->withErrors(['cart_data' => 'Keranjang kosong.']);
            }

            DB::beginTransaction();
            
            $total = 0;
            // validate stock and compute total
            foreach($items as $it){
                $product = Product::find($it['product_id']);
                if(!$product){
                    throw new \Exception('Produk tidak ditemukan.');
                }
                if($product->quantity < $it['quantity']){
                    throw new \Exception("Stok untuk {$product->name} tidak mencukupi. Tersedia: {$product->quantity}");
                }
                $total += $product->price * $it['quantity'];
            }

            // create sale (booted() will set sale_number and user_id)
            $sale = Sale::create([
                'payment_method_id' => $data['payment_method'] ?? null,
                'total' => $total,
                'status' => SaleStatus::PENDING,
            ]);

            // create detail lines and decrement stock
            foreach($items as $it){
                $product = Product::find($it['product_id']);
                $quantity = (int) $it['quantity'];
                $subtotal = $product->price * $quantity;

                DetailSale::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // decrement stock
                $product->quantity = max(0, $product->quantity - $quantity);
                $product->save();
            }

            DB::commit();

            // If request expects JSON (AJAX), return sale details
            if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                return response()->json([
                    'sale_id' => $sale->id,
                    'sale_number' => $sale->sale_number,
                ], 200);
            }

            // Sale created — redirect to show page for payment selection
            return redirect()->route('selling.show', $sale->id)->with('success', 'Penjualan disimpan dengan nomor ' . $sale->sale_number);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                return response()->json(['error' => $e->errors()], 422);
            }
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::with('detailSales.product')->findOrFail($id);
        $paymentMethods = PaymentMethod::orderBy('name')->get();
        return view('dashboard.selling.show', compact('sale', 'paymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = Sale::findOrFail($id);
        $data = $request->validate([
            'payment_method' => ['required','integer','exists:payment_methods,id'],
        ]);

        $sale->payment_method_id = $data['payment_method'];
        $sale->status = SaleStatus::COMPLETED;
        $sale->save();

        return redirect()->route('selling.index')->with('success', 'Pembayaran tersimpan untuk ' . $sale->sale_number);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display sales history with filter options
     */
    public function history(Request $request)
    {
        $query = Sale::with('paymentMethod', 'detailSales.product');

        // Filter by status
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by sale ID/number
        if ($request->filled('sale_search')) {
            $search = $request->sale_search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('sale_number', 'like', "%{$search}%");
            });
        }

        // Pagination
        $sales = $query->orderBy('created_at', 'desc')->paginate(10);
        $statuses = SaleStatus::cases();

        return view('dashboard.selling.history', compact('sales', 'statuses'));
    }
}
