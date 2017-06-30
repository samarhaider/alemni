<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        return view('admin.users',['users'=>\App\Models\User::with('profile')->get()]);
    }

    public function show(Request $request,$id){
        $user = \App\Models\User::findOrFail($id);
        $user->profile;
        $user->tutions;
        return view('admin.user',['user'=>$user]);
    }

    public function blockUser(Request $request,$id){
    	$user = \App\Models\User::findOrFail($id);
        \DB::table('users')
            ->where('id', $id)
            ->update(['block' => 1]);
        return back();
    } 

    public function unblockUser (Request $request,$id){
    	$user = \App\Models\User::findOrFail($id);
    	\DB::table('users')
            ->where('id', $id)
            ->update(['block' => 0]);
        return back();
    }

}
