<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Invitation;
use App\Models\Admin\Tution;
use Illuminate\Support\Facades\Validator;
class KhairController extends Controller
{
	public function index(){
		$khair = \App\Models\Tution::where('private',2)->get();
		return view('admin.khair.khairs',['khairs'=>$khair]);
	}
	public function show($id){
		$khair = \App\Models\Tuition::where('private',2)->where('id',$id)->first();
		return view('admin.khair',['khair'=>$khair]);
	}
	public function create($id){
		$tutor = \App\Models\User::findOrFail($id);
		return view('admin.khair.add',['tutor'=>$tutor]);
	}
	public function store(Request $request,$id){
		$validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'budget' => 'required',
            'daily_timing' => 'required',
            'invite_grade' => 'required',
            'invite_end_date' => 'required',
            
        ]);
        // Validation fails  
        if ($validator->fails()) {
           return back()->withErrors($validator)->withInput();
        }
		$tution = new Tution;
		$tution->title = $request->title;
		$tution->start_date = $request->start_date;
		$tution->latitude = $request->latitude;
		$tution->longitude = $request->longitude;
		$tution->budget = $request->budget;
		$tution->daily_timing = str_replace(' AM', '', $request->daily_timing);
		if($request->day_of_week_0)
			$tution->day_of_week_0 = 1;
		if($request->day_of_week_1)
			$tution->day_of_week_1 = 1;
		if($request->day_of_week_2)
			$tution->day_of_week_2 = 1;
		if($tution->day_of_week_3)
			$tution->day_of_week_3 = 1;
		if($tution->day_of_week_4)
			$tution->day_of_week_4 = 1;
		if($tution->day_of_week_5)
			$tution->day_of_week_5 = 1;
		if($tution->day_of_week_6)
			$tution->day_of_week_6 = 1;
		$tution->private = 2;
		$tution->tutor_id = $id;
		$tution->save();
		if ($request->get('subjects')) {
            $tution->retag($request->get('subjects'));
        }
		$invite = new Invitation;
		$invite->grade = $request->invite_grade;
		$invite->end_date = $request->invite_end_date;
		$invite->description = $request->description;
		$invite->tutor_id = $id;
		$invite->tution_id = $tution->id;
		$invite->save();
		return redirect('khairs');
	}

	public function edit(){
		return view('admin.khair.edit');
	}

	public function update(Request $request,$tution_id,$invite_id){
		$tution = \App\Models\Tuition::findOrFail($tution_id);
		$tution->title = $request->title;
		$tution->start_date = $request->start_date;
		$tution->latitude = $request->latitude;
		$tution->longitude = $request->longitude;
		$tution->budget = $request->budget;
		$tution->daily_timing = $request->daily_timing;
		$tution->day_of_week_0 = $request->day_of_week_0;
		$tution->day_of_week_1 = $request->day_of_week_1;
		$tution->day_of_week_2 = $request->day_of_week_2;
		$tution->day_of_week_3 = $request->day_of_week_3;
		$tution->day_of_week_4 = $request->day_of_week_4;
		$tution->day_of_week_5 = $request->day_of_week_5;
		$tution->day_of_week_6 = $request->day_of_week_6;
		$tution->day_of_week_7 = $request->day_of_week_7;
		$tution->private = 2;
		$tution->save();
		if ($request->get('subjects')) {
            $tution->retag($request->get('subjects'));
        }
		$invite = \App\Models\Invite::findOrFail($invite_id);
		$invite->grade = $request->invite_grade;
		$invite->end_date = $request->invite_end_date;
		$invite->description = $request->description;
		$invite->tutor_id = $request->tutor_id;
		$invite->tution_id = $request->tution_id;
		$invite->save();
		return redirect('khiar');
	}

	public function delete($tution_id){
		$tution = \App\Models\Tution::findOrFail($tution_id);
		$invite = $tution->khair_invitation;
		Tution::destroy($tution_id);
		if($invite)
		Invitation::destroy($invite->id);
		return bacK();
	}   
}
