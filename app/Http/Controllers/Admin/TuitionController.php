<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TuitionController extends Controller
{
    
	public function index(Request $request,$id =null){
		return view('admin.tuitions',['tutions'=>\App\Models\Tution::all()]);
	}
    
    public function show(Request $request,$id){
    	$tution = \App\Models\Tution::findOrFail($id);
    	$tution->tutorUser;
    	$tution->studentUser;
    	return view('admin.tuition',['tution'=>$tution]);
    }
}

