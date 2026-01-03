<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.payment-method.create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.payment-method.index');
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

        return back()->with('success', 'Metode pembayaran berhasil ditambahkan');
    }
}
