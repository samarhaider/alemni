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
     * List of Communications
     *
     * @Get("/")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"message":{"total":2,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":2,"data":{{"id":1,"last_message":{"id":52,"thread_id":"1","sender_id":"4","body":"I will be in meeting room","created_at":"2017-05-09 11:14:00"},"messages":{{"id":52,"thread_id":"1","sender_id":"4","body":"I will be in meeting room","created_at":"2017-05-09 11:14:00"}},"participants":{{"id":1,"thread_id":"1","user_id":"4","last_read":"2017-05-09 13:12:32","deleted_at":null,"user":{"id":4,"username":"jamaal23","email":"jamaal23@example.org","created_at":"2017-05-03 07:25:41","banned_at":null,"profile":{"name":"jamaal 23","weight":null,"height":null,"gender":null,"dob":null,"biceps":null,"shoulders":null,"gym_name":null,"avatar":null,"ethnicity":null,"latitude":null,"longitude":null,"description":null}}},{"id":2,"thread_id":"1","user_id":"11","last_read":null,"deleted_at":null,"user":{"id":11,"username":"cecelia.mertz","email":"jacquelyn20@example.com","created_at":"2017-05-09 10:05:19","banned_at":null,"profile":{"name":"Roslyn Smitham","weight":"140.14","height":"126.77","gender":"M","dob":"1977-12-30","biceps":"24.57","shoulders":"42.74","gym_name":"Glover, Lubowitz and Torphy","avatar":"http:\/\/lorempixel.com\/640\/480\/?18089","ethnicity":"4","latitude":"73.93778600","longitude":"-94.09201300","description":"I'm grown up now,' she added in a hurry. 'No, I'll look first,' she said, 'for her hair goes in such a puzzled expression that she knew the meaning of it in asking riddles that have no idea what."}}}},"pivot":{"user_id":"4","thread_id":"1","last_read":"2017-05-09 13:12:32"}}}}}),
     * })
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $threads = $user->threads()
            ->setEagerLoads(['messages' => function ($query) {
                    $query->latest();
                    $query->limit(1);
                }])
            ->with([
//                'participants',
                'participants.user.profile',
            ])
            ->paginate(20);
        foreach ($threads as $key => $thread) {
//            $thread->unread_messages_count = $thread->unreadMessagesCount;
//            $thread->last_message = $thread->lastMessage;
//            $thread->load([
//                'messages' => function ($query) {
//                    $query->latest();
//                    $query->limit(1);
//                }
//            ]);
            $thread->last_message = $thread->messages;
//            unset($thread->messages);
//            unset($thread->pivot);
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
     * 
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

    /**
     * List of Messages of Specific Thread
     * 
     * @Get("/{id}")
     * 
     * id is thread Id
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":52,"per_page":3,"current_page":1,"last_page":18,"next_page_url":"http:\/\/localhost:8000\/api\/messages\/1?page=2","prev_page_url":null,"from":1,"to":3,"data":{{"id":52,"thread_id":"1","sender_id":"4","body":"I will be in meeting room","created_at":"2017-05-09 11:14:00"},{"id":53,"thread_id":"1","sender_id":"4","body":"I will be in meeting room","created_at":"2017-05-09 11:14:00"},{"id":49,"thread_id":"1","sender_id":"4","body":"I will be in meeting room","created_at":"2017-05-09 11:13:59"}}})
     * })
     */
    public function show($id)
    {
        $user = Auth::user();
        $thread = $user->findThread($id)->setEagerLoads([])->firstOrFail();
        $user->markThreadAsRead($id);
        $messages = Message::where('thread_id', '=', $id)
            ->latest()
            ->paginate(20);
        $user->markThreadAsRead($id);
        return $messages;
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
            ->whereKey($id)
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

    /**
     * Read Thread/Messages
     *
     * @Post("/read-thread")
     * 
     * @Parameters({
     *      @Parameter("thread_id", type="integer", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"thread_id": 2}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"message_thread":{"id":2,"pivot":{"user_id":"4","thread_id":"2","last_read":"2017-05-09 13:15:59"}}}),
     *      @Response(422, body={"message":"Could not read Messages.","errors":{"thread_id":{"The thread_id field is required."}},"status_code":422})
     * })
     */
    public function ReadThread(Request $request)
    {
        $user = Auth::user();
        $thread_id = $request->get('thread_id', false);
        if (!$thread_id) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not read Messages.', ['errors' => ['thread_id' => "The Thread Id field is required."]]);
        }
        $user->markThreadAsRead($thread_id);
        return $user->findThread($thread_id)->setEagerLoads([])->first();
    }
}
