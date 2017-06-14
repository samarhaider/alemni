<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Tution;
use Auth;
use Carbon\Carbon;

/**
 * @Resource("Lecture", uri="/lectures" )
 */
class LectureController extends Controller
{

    /**
     * List of Lectures
     * 
     *
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("tution_id", type="integer")
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":1,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":1,"data":{{"id":1,"tution_id":"3","start_time":"2017-06-04 12:19:48","end_time":"2017-06-04 12:24:48","goals":"This is cover letter","reviews":"reviews reviews reviews, reviews","lecture_number":"1","progress":"10","attachments":{"attachments\/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments\/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"},"created_at":"2017-06-04 12:19:48","updated_at":"2017-06-04 12:24:48","deleted_at":null}}})
     * })
     */
    public function index(Request $request)
    {
        $tution_id = $request->get('tution_id', 0);
        $lectures = new Lecture;
        $lectures->findTution($tution_id);
        return $lectures->latest()->paginate(20);
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
     * Start Lecture
     * 
     * @Post("/start")
     * 
     * @Parameters({
     *      @Parameter("tution_id", type="integer", required=true),
     *      @Parameter("goals", required=true)
     * })
     * @Transaction({
     *      @Request({"tution_id":  3, "goals": "This is cover letter"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"lecture":{"tution_id":3,"goals":"This is cover letter","lecture_number":1,"start_time":"2017-06-04 12:19:48","updated_at":"2017-06-04 12:19:48","created_at":"2017-06-04 12:19:48","id":1}}),
     *      @Response(422, body={"message":"Could not start Lecture.","errors":{"tution_id":{"The tution id field is required."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not start Lecture.","errors":{"tution_id":{"You have already started lecture."}},"status_code":422})
     * })
     */
    public function start(Request $request)
    {
        $user = Auth::user();
        if (!$user->isTutor()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not start Lecture.', ['tution_id' => 'You are not allowed to start lecture on this tution.']);
        }
        $lecture = new Lecture($request->all());
        $lecture->startValidation(true);
        if ($lecture->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not start Lecture.', $lecture->getErrors());
        }
        if ($lecture->tution->status != Tution::STATUS_INPROGRESS) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not start Lecture.', ['tution_id' => 'Tutions is not in progress.']);
        }
        $last_lecture = Lecture::findTution($lecture->tution_id)->latest()->first();
        if ($last_lecture && !$last_lecture->end_time) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not start Lecture.', ['tution_id' => 'You have already started lecture.']);
        }
        $total_lectures = Lecture::findTution($lecture->tution_id)->count();
        $lecture->lecture_number = $total_lectures + 1;
        $lecture->start_time = Carbon::now();
        $lecture->save();
        return $lecture;
    }

    /**
     * End lecture
     *
     * @Post("/{lecture_id}/end")
     * 
     * @Parameters({
     *      @Parameter("attachments", type="array", description="array of objects"),
     *      @Parameter("reviews", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"reviews": "reviews reviews reviews, reviews", "progress": 10,"attachments":{"attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"}}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"lecture":{"id":1,"tution_id":"3","start_time":"2017-06-04 12:19:48","end_time":"2017-06-04 12:24:48","goals":"This is cover letter","reviews":"reviews reviews reviews, reviews","lecture_number":"1","progress":10,"attachments":{"attachments\/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments\/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"},"created_at":"2017-06-04 12:19:48","updated_at":"2017-06-04 12:24:48","deleted_at":null}}),
     *      @Response(422, body={"message":"Could not end Lecture.","errors":{"tution_id":{"You have already ended lecture."}},"status_code":422})
     * })
     */
    public function end(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->isTutor()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not end Lecture.', ['tution_id' => 'You are not allowed to end lecture on this tution.']);
        }
        $lecture = Lecture::whereKey($id)->firstOrFail();
        $lecture->fill($request->all());
        $lecture->endValidation(true);
        if ($lecture->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not end Lecture.', $lecture->getErrors());
        }
        if ($lecture->tution->status != Tution::STATUS_INPROGRESS) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not end Lecture.', ['tution_id' => 'Tutions is not in progress.']);
        }
        if ($lecture->end_time) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not end Lecture.', ['tution_id' => 'You have already ended lecture.']);
        }
        $lecture->end_time = Carbon::now();
        $lecture->save();
        return $lecture;
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

    public function update(Request $request, $id)
    {
        
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
