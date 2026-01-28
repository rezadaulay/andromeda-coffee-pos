<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

    public function index(){
        $paymentMethods = PaymentMethod::orderBy('name')->paginate(20);
        return view('dashboard.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('payment-methods.index')->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }
    
    public function show(string $id){
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('dashboard.payment-method.detail', compact('paymentMethod'));
    }


   
    public function edit(string $id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view("dashboard.payment-methods.edit",compact('method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $method = PaymentMethod::findOrFail($id);
        $method->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('payment-methods.index')->with('success', 'Metode pembayaran berhasil diperbarui!');
    }



    public function destroy(string $id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->delete();

        return redirect()->route('payment-methods.index')
                     ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}
