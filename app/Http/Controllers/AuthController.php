<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

use App\Http\Requests\LoginAuthRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'getLogin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginAuthRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('home');
        } else {
            return redirect()->back()->
                with('dangerMessage', 'Email atau password tidak cocok');
        }
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('auth.login.get')
            ->with('successMessage', 'Berhasil keluar');
    }
}
