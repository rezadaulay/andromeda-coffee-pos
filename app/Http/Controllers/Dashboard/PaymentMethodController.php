<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methods = PaymentMethod::paginate(20);
        return view("dashboard.paymentmethod.index",compact('methods'));
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
        $method = PaymentMethod::findOrFail($id);
        return view("dashboard.paymentmethod.edit",compact('method'));
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

        return back()->with('success', 'Metode pembayaran berhasil diperbarui!');
    }

    public function delete($id)
    {
    $method = PaymentMethod::findOrFail($id);
    return view('dashboard.paymentmethod.delete', compact('method'));
    }


    public function destroy(string $id)
    {
        $method = PaymentMethod::findOrFail($id);
    $method->delete();

    return redirect()->route('paymentmethod.index')
                     ->with('success', 'Data berhasil dihapus');
    }
}
