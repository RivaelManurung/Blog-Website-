<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/dashboard'; // PENTING!

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }
}