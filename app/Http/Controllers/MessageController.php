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

    /**
     * List of my messages
     *
     * @Get("/")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":2,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":2,"data":{{"id":2,"unread_messages_count":3,"last_message":{"id":7,"thread_id":"2","sender_id":"10","body":"Fine","created_at":"2017-04-16 13:59:09"},"participants":{{"id":3,"thread_id":"2","user_id":"11","last_read":null,"deleted_at":null},{"id":4,"thread_id":"2","user_id":"10","last_read":null,"deleted_at":null}},"pivot":{"user_id":"10","thread_id":"2","last_read":null},"messages":{{"id":3,"thread_id":"2","sender_id":"11","body":"Salam","created_at":"2017-04-16 13:53:37"},{"id":4,"thread_id":"2","sender_id":"11","body":"How are you?","created_at":"2017-04-16 13:53:44"},{"id":5,"thread_id":"2","sender_id":"11","body":"Wait!","created_at":"2017-04-16 13:53:52"},{"id":6,"thread_id":"2","sender_id":"10","body":"WS","created_at":"2017-04-16 13:59:01"},{"id":7,"thread_id":"2","sender_id":"10","body":"Fine","created_at":"2017-04-16 13:59:09"}}},{"id":3,"unread_messages_count":4,"last_message":{"id":11,"thread_id":"3","sender_id":"5","body":"I will be in meeting room","created_at":"2017-04-17 06:57:15"},"participants":{{"id":5,"thread_id":"3","user_id":"5","last_read":null,"deleted_at":null},{"id":6,"thread_id":"3","user_id":"10","last_read":null,"deleted_at":null}},"pivot":{"user_id":"10","thread_id":"3","last_read":null},"messages":{{"id":8,"thread_id":"3","sender_id":"5","body":"Hello,","created_at":"2017-04-17 06:55:11"},{"id":9,"thread_id":"3","sender_id":"5","body":"Lets discuss on new project","created_at":"2017-04-17 06:55:25"},{"id":10,"thread_id":"3","sender_id":"5","body":"I will be in meeting room","created_at":"2017-04-17 06:57:01"},{"id":11,"thread_id":"3","sender_id":"5","body":"I will be in meeting room","created_at":"2017-04-17 06:57:15"}}}}})
     * })
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $threads = $user->threads()
            ->with('participants')
            ->paginate(20);
        foreach ($threads as $key => $thread) {
            $thread->unread_messages_count = $thread->unreadMessagesCount;
            $thread->last_message = $thread->lastMessage;
            unset($thread->messages);
        }
        return $threads;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Send Message to User
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("user_id", type="integer", required=true),
     *      @Parameter("message", required=true)
     * })
     * @Transaction({
     *      @Request({"user_id": 11, "message": "I will be in meeting room"}),
     *      @Response(200, body={"message":{"id":12,"thread_id":"4","sender_id":"5","body":"I will be in meeting room","created_at":"2017-04-17 06:57:39"}}),
     *      @Response(422, body={"message":"Could not add Message.","errors":{"message":{"The message field is required."},"user_id":{"The user id field is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        $sender = Auth::user();
        $user_id = $request->get('user_id');
        $message = $request->get('message');
        $reciever = User::findOrFail($user_id);
        $ret = Messenger::from($sender)->to($reciever)->message($message)->send();
        return $sender->messagesSent()->latest()->first();
    }

    
    public function show($id)
    {
/**
     * Message Information
     *
     * @Get("/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={})
     * })
     */        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::fromSender(Auth::user()->id)
            ->where('id', '=', $id)
            ->firstOrFail();
        $message->delete();
        return $message;
    }

    /**
     * Unread Messages Count
     *
     * @Get("/unread-messages-count")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"unread_messages_count":4})
     * })
     */
    public function UnreadMessagesCount(Request $request)
    {
        $user = Auth::user();
        $unread_messages_count = 0;
        $thread_id = $request->get('thread_id', false);
        if ($thread_id) {
            $user = $user->findThread($thread_id)
                ->first();
            if ($user) {
                $unread_messages_count = $user->unreadMessagesCount;
            }
        } else {
            $unread_messages_count = $user->unreadMessagesCount;
        }
        return [
            'unread_messages_count' => $unread_messages_count,
        ];
    }
}
