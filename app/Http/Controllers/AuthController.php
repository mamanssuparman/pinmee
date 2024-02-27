<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        return view('register');
    }

    public function registered(Request $request){
        $request->validate([
            'email'     => 'required|unique:users,email',
            'password'  => 'required',
            'tgl_lahir' => 'required'
        ]);
        $dataStore = [
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'tgl_lahir' => $request->tgl_lahir
        ];
        User::create($dataStore);
        return redirect('/register')->with('success', 'Data berhasil di simpan');
    }

    public function auth(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect('/explore');
        } else {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
