<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // Pastikan baris 'use' ini ada.
    // Keduanya memberikan fungsionalitas penting seperti validasi dan otorisasi.
    // Method middleware() datang dari BaseController yang di-extend.
    use AuthorizesRequests, ValidatesRequests;
}