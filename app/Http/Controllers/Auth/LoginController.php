<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show () {
        return view('auth.login');
    }

    public function post (Request $request) { 
        // return 'masuk kesini ya';
        // $request seperti post

        // https://laravel.com/docs/12.x/validation#quick-writing-the-validation-logic
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // ketika validasi gagal, maka redirect kembali ke halaman asal (/login) sekaligus sisipkan variable $errors
        
        // logic login

        // cari user bedasarkan email
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            // ketika user tidak ditemukan, maka redirect kembali ke halaman asal (/login) sekaligus sisipkan variable $errors
            return back()->withErrors([
                'email' => 'Email tidak dikenal.',
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            // ketika user tidak ditemukan, maka redirect kembali ke halaman asal (/login) sekaligus sisipkan variable $errors
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }
        
        // jika login sukses maka simpan sesi
        Auth::loginUsingId($user->id); // maka simpan sesi login bedasarkan id $user

        return redirect()->route('dashboard.index');
    }
}
