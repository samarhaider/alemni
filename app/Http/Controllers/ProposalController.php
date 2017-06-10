<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tution;
use App\Models\Proposal;
use App\Models\User;
use Auth;
use App\Notifications\ProposalRecieved;
use App\Notifications\ProposalAccepted;

/**
 * @Resource("Proposal", uri="/proposals" )
 */
class ProposalController extends Controller
{

    /**
     * List of Proposals
     *
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("status", type="integer", description="1 = pending, 2 = accepted, 3 = rejected, 4 = with drawl")
     * })
     * 
     * @Transaction({
     *      @Request({"status": 1 }, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":1,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":1,"data":{{"id":2,"tutor_id":"5","tution_id":"3","status":"1","description":"This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:59:26","updated_at":"2017-04-18 17:59:26","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}}})
     * })
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $proposals = new Proposal;
        if ($user->isTutor()) {
            $proposals = Proposal::findTutor($user->id);
        } else {
            $proposals = Proposal::whereHas('tution', function($query) use ($user) {
                    $query->where('tutions.student_id', '=', $user->id);
                });
        }
        $status = $request->get('status', false);
        if ($status) {
            $proposals->status($status);
        }
        return $proposals->latest()->paginate(20);
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
     * Submit Proposal by Tutor
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("title", required=true),
     *      @Parameter("availability_from"),
     *      @Parameter("availability_to"),
     *      @Parameter("schedule"),
     *      @Parameter("attachments", type="array", description="array of objects"),
     *      @Parameter("tution_id", type="integer", required=true),
     *      @Parameter("description", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"title": "title abc", "tution_id": 3, "description": "This is cover letter"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"tution_id":3,"description":"This is cover letter","tutor_id":10,"updated_at":"2017-04-18 17:32:47","created_at":"2017-04-18 17:32:47","id":1}}),
     *      @Response(422, body={"message":"Could not submit Proposal.","errors":{"tution_id":{"You have already applied on this tution."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not submit Proposal.","errors":{"description":{"The description id field is required."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not submit Proposal.","errors":{"tution_id":{"The tution id field is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->isTutor()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Proposal.', ['tution_id' => 'You are not allowed to apply on this tution.']);
        }
        $proposal = new Proposal($request->all());
        $proposal->tutor_id = $user->id;
        if ($proposal->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Proposal.', $proposal->getErrors());
        }
        $already_proposal = Proposal::findTutor($user->id)
            ->findTution($proposal->tution_id)
            ->count();
        if ($already_proposal) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Proposal.', ['tution_id' => 'You have already applied on this tution.']);
        }
        $proposal->status = Proposal::STATUS_PENDING;
        $proposal->save();
        $student = User::find($proposal->tution->student_id);
        $student->notify(new ProposalRecieved($proposal));
        return $proposal;
    }

    /**
     * View specific proposal
     *
     * @Get("/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body=    {"proposal":{"id":1,"tutor_id":"10","tution_id":"3","status":"1","description":"This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:32:47","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->isTutor()) {
            $proposal = Proposal::findTutor($user->id);
        } else {
            $proposal = Proposal::whereHas('tution', function($query) use ($user) {
                    $query->where('tutions.student_id', '=', $user->id);
                });
        }
        $proposal = $proposal->where('id', $id)
            ->firstOrFail();
        return $proposal;
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
     * Update Proposal by Tutor
     * 
     * @Post("/{id}")
     * 
     * @Parameters({
     *      @Parameter("description", required=true)
     * })
     * @Transaction({
     *      @Request({"description": "This is cover letter"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"tution_id":3,"description":"This is cover letter","tutor_id":10,"updated_at":"2017-04-18 17:32:47","created_at":"2017-04-18 17:32:47","id":1}}),
     *      @Response(422, body={"message":"Could not submit Proposal.","errors":{"description":{"The description id field is required."}},"status_code":422})
     * })
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $proposal = Proposal::findTutor($user->id)
            ->where('id', $id)
            ->firstOrFail();
        $proposal->fill($request->all());
        if ($proposal->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not submit Proposal.', $proposal->getErrors());
        }
        $proposal->save();
        return $proposal;
    }

    /**
     * Withdrawl proposal by Tutor
     * 
     * @Post("/withdrawl/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"id":1,"tutor_id":"10","tution_id":"3","status":4,"description":"Update: This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:57:20","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function withdrawl(Request $request, $id)
    {
        $user = Auth::user();
        $proposal = Proposal::findTutor($user->id)
            ->whereKey($id)
            ->status(Proposal::STATUS_PENDING)
            ->firstOrFail();
        $proposal->status = Proposal::STATUS_WITHDRAWL;
        $proposal->save();
        return $proposal;
    }

    /**
     * Accept proposal by Student
     * 
     * @Post("/accept/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"id":1,"tutor_id":"10","tution_id":"3","status":4,"description":"Update: This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:57:20","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function accept(Request $request, $id)
    {
        $user = Auth::user();
        $proposal = Proposal::whereHas('tution', function($query) use ($user) {
                $query->where('tutions.student_id', '=', $user->id);
            })
            ->whereKey($id)
            ->status(Proposal::STATUS_PENDING)
            ->firstOrFail();

        $tution = Tution::whereKey($proposal->tution_id)
            ->status(Tution::STATUS_NEW)
//            ->findStudent($user->id)
            ->firstOrFail();

        $proposal->status = Proposal::STATUS_ACCEPTED;
//        $proposal->fill($request->all());
//        $proposal->acceptValidation(true);
        if ($proposal->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not accept Proposal.', $proposal->getErrors());
        }

        $proposal->save();
        $tution->tutor_id = $proposal->tutor_id;
        $tution->status = Tution::STATUS_INPROGRESS;
        $tution->save();
        
        $student = User::find($proposal->tutor_id);
        $student->notify(new ProposalAccepted($proposal));
        return $proposal;
    }

    /**
     * Reject proposal by Student
     * 
     * @Post("/reject/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"proposal":{"id":1,"tutor_id":"10","tution_id":"3","status":4,"description":"Update: This is cover letter","deleted_at":null,"created_at":"2017-04-18 17:32:47","updated_at":"2017-04-18 17:57:20","tution":{"id":3,"student_id":"11","tutor_id":null,"status":"1","private": true,"title":"Tution 1","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12 00:00:00","daily_timing":"05:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:05"}}})
     * })
     */
    public function reject(Request $request, $id)
    {
        $user = Auth::user();
        $proposal = Proposal::whereHas('tution', function($query) use ($user) {
                $query->where('tutions.student_id', '=', $user->id);
            })
            ->status(Proposal::STATUS_PENDING)
            ->whereKey($id)
            ->firstOrFail();
        $proposal->status = Proposal::STATUS_REJECTED;
        $proposal->save();
        return $proposal;
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
