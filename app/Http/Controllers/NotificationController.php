<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

/**
 * @Resource("Notifications", uri="/notifications" )
 */
class NotificationController extends Controller
{

      /**
     * List of Notifications
     *
     * @Get("/")
     * 
     * @Parameters({
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":1,"per_page":10,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":1,"data":{{"id":"575c031c-60db-4d53-b5fb-b3f8ec00587e","type":"App\\Notifications\\InvitationRecieved","notifiable_id":"6","notifiable_type":"App\\Models\\User","data":{"student_id":"11","tution_id":31,"message":"Sam has sent you tution invitation."},"read_at":null,"created_at":"2017-06-10 09:39:37","updated_at":"2017-06-10 09:39:37"}}})
     * })
     */
    public function index()
    {
        return Auth::user()->notifications()->paginate(10);
    }

    public function unread()
    {
        return Auth::user()->unreadNotifications()->paginate(10);
    }

    public function read()
    {
        $read_notficiations = Auth::user()
            ->unreadNotifications()
            ->update(['read_at' => Carbon::now()]);
        return [
            'read_count' => $read_notficiations,
        ];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
//
//    /**
//     * Delete notification
//     *
//     * @Post("/{notification_id}")
//     * 
//     * @Parameters({
//     *      @Parameter("notification_id", description="Notification ID", required=true)
//     * })
//     * 
//     * @Transaction({
//     *      @Response(200, body={"notification":{"notification_id":"Notification 2","user_id":15,"updated_at":"2017-04-27 09:50:33","created_at":"2017-04-27 09:50:33","id":2}})
//     * })
//     */
    public function destroy($id)
    {
        Auth::user()
            ->notifications()
            ->whereKey($id)
            ->delete();
        return [];
    }
}
