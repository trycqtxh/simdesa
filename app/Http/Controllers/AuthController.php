<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check())
          return redirect()->route('profil.desa');

        return view('layouts.login');
    }

    public function prosesLogin(Request $request)
    {

        $this->validate($request, [
            'nip'      => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['nip' => $request->nip, 'password'=>$request->password]) || Auth::attempt(['niap'=>$request->nip, 'password'=>$request->password])) {
            return redirect()->route('profil.desa');
        }
        return redirect()->back()->withErrors(['message'=>'NIP / NIAP atau Password yang anda masukan salah']);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
