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

   public function index(Request $request){
        $user = Auth::user();
        
    }

    public function create(){
    
    }

    
    public function store(Request $request){
        $user = Auth::user();
        $message = new \App\Message;
        $message->tuition_id = $request->tuition_id;
        $message->type = $request->type;
        if($message->type == 'file'){
            
        }
    }

    public function show($id){
    
    }

   
    public function edit($id){
        //
    }

  
    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        
    }


}
