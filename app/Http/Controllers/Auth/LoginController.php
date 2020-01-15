<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
	
	protected $redirectTo = '/';
	
	
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
