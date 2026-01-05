<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(){
        $paymentMethods = PaymentMethod::orderBy('name')->paginate(2);
        return view('dashboard.payment-method.index', compact('paymentMethods'));
    }

    public function show(string $id){
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('dashboard.payment-method.detail', compact('paymentMethod'));
    }
}
