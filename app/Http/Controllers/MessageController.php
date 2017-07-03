<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Messenger;
use Gerardojbaez\Messenger\Models\Message;
use App\Models\User;

/**
 * @Resource("Messages", uri="/messages" )
 */
class MessageController extends Controller
{
	public function store(Request $request){
		$user = Auth::user();
		$message = new \App\Models\Message;
		$message->tuition_id = $request->tuition_id;
		$message->sender_id = $user->id;
		$message->reciever_id = $request->reciever_id;
		$message->type = $request->type;
		if($request->type == 'file'){
			$hash_name = $request->file('file')->hashName();
            $hash_name = explode('.', $hash_name);
            $hash_name = $hash_name[0];
            $ext = $request->file('file')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('chatFiles', $request->file('content'), $hash_name.'.'.$ext);
            $message->message = $request->type.'/'.$hash_name.'.'.$ext;
            $message->file_type = $request->file_type;
		}
		elseif($request->type == 'text'){
			$message->message = $request->message;
		}
		$message->save();
		return $message;
	}
	public function show($id){
		$tuition = \App\Tuition::findOrFail($id);
		return $tuition->messages();
	}
}