<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/admin/dashboard'; // PENTING!

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        // parent::__construct(); // <-- HAPUS BARIS INI
        
        $this->middleware('guest')->except('logout');
    }
}