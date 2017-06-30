<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 1])) {
    		return redirect()->intended('users');
		}
		else{
			echo "Invalid Login";
		}
    }
    public function logout(Request $request){
    	Auth::logout();
    	return redirect('login');
    }
}
