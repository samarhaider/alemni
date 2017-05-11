<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Tution;
use Auth;

/**
 * @Resource("Invitation", uri="/invitations" )
 */
class InvitationController extends Controller
{

    /**
     * List of Invitations
     * 
     *
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("status", type="integer", description="1 = pending, 2 = accepted, 3 = rejected, 4 = with drawl")
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":1,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":1,"data":{{"id":2,"tutor_id":"5","tution_id":"3","status":"1","description":"This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:59:26","updated_at":"2017-04-18 17:59:26","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}}})
     * })
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $invitations = new Invitation;
        if ($user->isTutor()) {
            $invitations = Invitation::findTutor($user->id);
        } else {
            $invitations = Invitation::whereHas('tution', function($query) use ($user) {
                    $query->where('tutions.student_id', '=', $user->id);
                });
        }
        $status = $request->get('status', Invitation::STATUS_PENDING);
        if ($status) {
            $invitations->status($status);
        }
        return $invitations->latest()->paginate(20);
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
     * Submit Invitation by Student
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("attachments", type="array", description="array of objects"),
     *      @Parameter("description"),
     *      @Parameter("grade"),
     *      @Parameter("end_date"),
     *      @Parameter("tution_id", type="integer", required=true),
     *      @Parameter("tutor_id", type="integer", required=true)
     * })
     * @Transaction({
     *      @Request({"tutor_id": 7, "tution_id": 3,"attachments":{"attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"}}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"invitation":{"tutor_id":7,"tution_id":3,"attachments":{"attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"},"updated_at":"2017-04-18 18:15:06","created_at":"2017-04-18 18:15:06","id":1}}),
     *      @Response(422, body={"message":"Could not submit Invitation.","errors":{"tution_id":{"You have already sent invitation of this tutor."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not submit Invitation.","errors":{"tution_id":{"The tution id field is required."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not submit Invitation.","errors":{"tutor_id":{"The tutor id field is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->isStudent()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Invitation.', ['tution_id' => 'You are not allowed to sent invitation on this tution.']);
        }
        $invitation = new Invitation($request->all());
        if ($invitation->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Invitation.', $invitation->getErrors());
        }
        if (!$invitation->tution || $invitation->tution->student_id != $user->id) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Invitation.', ['tution_id' => 'You have already sent invitation of this tutor.']);
        }
        $already_invitation = Invitation::findTutor($invitation->tutor_id)
            ->findTution($invitation->tution_id)
            ->count();
        if ($already_invitation) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Invitation.', ['tution_id' => 'You have already sent invitation of this tutor.']);
        }
        $invitation->save();
        return $invitation;
    }

    /**
     * View specific invitation
     *
     * @Get("/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"invitation":{"id":1,"tutor_id":"10","tution_id":"3","status":"1","description":"This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:32:47","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->isTutor()) {
            $invitation = Invitation::findTutor($user->id);
        } else {
            $invitation = Invitation::whereHas('tution', function($query) use ($user) {
                    $query->where('tutions.student_id', '=', $user->id);
                });
        }
        $invitation = $invitation->where('id', $id)
            ->firstOrFail();
        return $invitation;
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
     * Update Invitation
     * 
     * @Post("/{id}")
     * 
     * @Parameters({
     *      @Parameter("description", required=true)
     * })
     * @Transaction({
     *      @Request({ "description": "This is cover letter"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"invitation":{"tution_id":3,"description":"This is cover letter","tutor_id":10,"updated_at":"2017-04-18 17:32:47","created_at":"2017-04-18 17:32:47","id":1}}),
     *      @Response(422, body={"message":"Could not update Invitation.","errors":{"description":{"The description id field is required."}},"status_code":422})
     * })
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $invitation = Invitation::where('id', $id)
            ->firstOrFail();
        $invitation->fill($request->all());
        if ($invitation->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update Invitation.', $invitation->getErrors());
        }
        $invitation->save();
        return $invitation;
    }

    /**
     * Reject invitation by Tutor
     * 
     * @Post("/reject/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"invitation":{"id":1,"tutor_id":"10","tution_id":"3","status":3,"description":"Update: This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:57:20","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function reject(Request $request, $id)
    {
        $user = Auth::user();
        $invitation = Invitation::findTutor($user->id)
            ->where('id', $id)
            ->status(Invitation::STATUS_PENDING)
            ->firstOrFail();
        $invitation->status = Invitation::STATUS_REJECTED;
        $invitation->save();
        return $invitation;
    }

    /**
     * Accept Invitation by Tutor
     * 
     * @Post("/accept/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"id":1,"tutor_id":"10","tution_id":"3","status":4,"description":"Update: This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:57:20","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}}),
     *      @Response(422, body={"message":"Could not accept Invitation.","errors":{"description":{"The description id field is required."}},"status_code":422})
     * })
     */
    public function accept(Request $request, $id)
    {
        $user = Auth::user();
        $invitation = Invitation::findTutor($user->id)
            ->whereKey($id)
            ->status(Invitation::STATUS_PENDING)
            ->firstOrFail();

        $tution = Tution::whereKey($invitation->tution_id)
            ->status(Tution::STATUS_NEW)
//            ->findStudent($user->id)
            ->firstOrFail();

        $invitation->status = Invitation::STATUS_ACCEPTED;
        $invitation->fill($request->all());
//        $invitation->acceptValidation(true);
        if ($invitation->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not accept Invitation.', $invitation->getErrors());
        }
        $invitation->save();
        $tution->tutor_id = $invitation->tutor_id;
        $tution->status = Tution::STATUS_INPROGRESS;
        $tution->save();
        return $invitation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
