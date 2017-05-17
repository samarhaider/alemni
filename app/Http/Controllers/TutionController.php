<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Tution;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Invitation;
use willvincent\Rateable\Rating;

/**
 * @Resource("Tutions", uri="/tutions" )
 */
class TutionController extends Controller
{

    /**
     * List of my tutions
     *
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("search_type", description="1= new, 2= pending 3=completed, 100=near by me")
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":2,"per_page":20,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":2,"data":{{"id":6,"student_id":"11","tutor_id":"6","status":"2","private":true,"title":"Tution 6","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12","daily_timing":"05:00:00","city":null,"state":null,"date":null,"time":null,"attachments":{},"day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 19:20:03","subjects":{},"last_class":"","answers":{},"student":{"id":13,"gender":"M","name":"Sam","avatar":"uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","latitude":"-69.92557000","longitude":"-144.58138800","address":"My locatio","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"12.00","radius":"5000","experience":"1","stage_complete":null,"teaches":null,"city":null,"state":null,"paypal_address":null,"specialist":null,"qualifications":{"Mba","Bs"},"average_rating":"3.0000","completed_tutions":2,"avatar_url":"http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","total_hours":5,"user":{"id":11,"email":"cleta71@example.net","user_type":"2","created_at":"2017-04-06 05:28:03"}}},{"id":4,"student_id":"11","tutor_id":"6","status":"2","private":true,"title":"Tution 4","budget":"100 dollar","latitude":"11.45609800","longitude":"-51.78216000","start_date":"2019-08-12","daily_timing":"05:00:00","city":null,"state":null,"date":null,"time":null,"attachments":{},"day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"description":null,"created_at":"2017-04-12 17:32:16","subjects":{},"last_class":"","answers":{},"student":{"id":13,"gender":"M","name":"Sam","avatar":"uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","latitude":"-69.92557000","longitude":"-144.58138800","address":"My locatio","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"12.00","radius":"5000","experience":"1","stage_complete":null,"teaches":null,"city":null,"state":null,"paypal_address":null,"specialist":null,"qualifications":{"Mba","Bs"},"average_rating":"3.0000","completed_tutions":2,"avatar_url":"http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","total_hours":5,"user":{"id":11,"email":"cleta71@example.net","user_type":"2","created_at":"2017-04-06 05:28:03"}}}}})
     * })
     */
    public function index(Request $request)
    {
        $tutor_id = $student_id = false;
        $search_type = $request->get('search_type', Tution::STATUS_NEW);
        $relations = null;
        if (Auth::user()->isStudent()) {
            $student_id = Auth::user()->id;
            $relations = ['tutor', 'invitations.tutor'];
//            $relations[] = 'proposals.tutor';
        }
        if (Auth::user()->isTutor()) {
            $tutor_id = Auth::user()->id;
            $relations = 'student';
        }

        $tutions = Tution::with($relations);
//            ->join('questions', 'questions.id', '=', 'tutions.question_id');
        if ($student_id) {
            $tutions->findStudent($student_id);
        }
        if ($tutor_id && ($search_type != 1 && $search_type != 100)) {
            $tutions->findTutor($tutor_id);
        }
        if ($search_type < 5) {
            $tutions->status($search_type);
            if (Auth::user()->isTutor() && $search_type == Tution::STATUS_NEW) {
                $tutions->publicOnly();
//                $tutions->publicOnlyAndInvitedUser(Auth::user()->id);
            }
        }
        if ($search_type == 100) {
            $tutions->status(Tution::STATUS_NEW);
            $profile = Auth::user()->profile;
            $latitude = $request->get('latitude', $profile->latitude);
            $longitude = $request->get('longitude', $profile->longitude);
            $distance = $request->get('radius', 5000);
            $tutions->nearBy($latitude, $longitude, $distance);
            $tutions->publicOnly();
//            $tutions->publicOnlyAndInvitedUser(Auth::user()->id);
        }
        $tutions->latest();
        return $tutions->paginate(20);
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
     * Create Tution
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("title", description="Customer Name"),
     *      @Parameter("private", type="boolean", required=true),
     *      @Parameter("start_date", type="date", description="date format Y-m-d like 2016-12-12", required=true),
     *      @Parameter("latitude", type="decimal", required=true),
     *      @Parameter("longitude", type="decimal", required=true),
     *      @Parameter("budget", required=true),
     *      @Parameter("daily_timing", type="time", description="time format H:i:s like 22:00:00", required=true),
     *      @Parameter("day_of_week_0", type="boolean", required=true),
     *      @Parameter("day_of_week_1", type="boolean", required=true),
     *      @Parameter("day_of_week_2", type="boolean", required=true),
     *      @Parameter("day_of_week_3", type="boolean", required=true),
     *      @Parameter("day_of_week_4", type="boolean", required=true),
     *      @Parameter("day_of_week_5", type="boolean", required=true),
     *      @Parameter("day_of_week_6", type="boolean", required=true),
     *      @Parameter("subjects", type="array", description="string array of subjects"),
     *      @Parameter("answers", type="array", description="array of objects", required=true),
     *      @Parameter("attachments", type="array", description="array of objects"),
     *      @Parameter("description")
     * })
     * 
     * @Transaction({
     *      @Request({"title":"Tution 3","private": true,"budget":"100 dollar","start_date": "2018-20-12", "day_of_week_0": 1, "day_of_week_1": 1, "day_of_week_2": 1, "day_of_week_3": 1, "day_of_week_4": 1, "day_of_week_5": 1, "day_of_week_6": 1, "latitude": "11.45609800", "longitude": "-51.78216000", "daily_timing": "05:00:00", "subjects": {"English","Urdu"}, "answers":{{"question_id": 1,"choice_id": 2},{"question_id": 4,"choice_id": 2},{"question_id": 6,"choice_id": 2},{"question_id": 8,"choice_id": 2},{"question_id": 12,"choice_id": 2},"attachments":{"attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"}} }, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"tution":{"title":"Tution 3","private": true,"budget":"100 dollar","attachments":{"attachments/TaGt2P3apz8q8XWbCWMNbsvsBScXmMMEy6puh0Lv.txt","attachments/rmF19P8Pc2HfvrUYu3RQaEihAymFekNm51aTdFr2.html"},"start_date":"2019-08-12 00:00:00","day_of_week_0":true,"day_of_week_1":true,"day_of_week_2":true,"day_of_week_3":true,"day_of_week_4":true,"day_of_week_5":true,"day_of_week_6":true,"latitude":"11.45609800","longitude":"-51.78216000","daily_timing":"05:00:00", "subjects": {"English","Urdu"},"student_id":11,"created_at":"2017-04-12 17:32:21","id":5,"answers":{{"id":21,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"1","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":22,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"4","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":23,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"6","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":24,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"8","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":25,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"12","choice_id":"2","created_at":"2017-04-12 17:32:22"}}}}),
     *      @Response(422, body={"message":"Could not add Tution.","errors":{"title":{"The title field is required."},"budget":{"The budget field is required."},"latitude":{"The latitude field is required."},"longitude":{"The longitude field is required."},"start_date":{"The start date field is required."},"daily_timing":{"The daily timing field is required."},"day_of_week_0":{"The day of week 0 field is required."},"day_of_week_1":{"The day of week 1 field is required."},"day_of_week_2":{"The day of week 2 field is required."},"day_of_week_3":{"The day of week 3 field is required."},"day_of_week_4":{"The day of week 4 field is required."},"day_of_week_5":{"The day of week 5 field is required."},"day_of_week_6":{"The day of week 6 field is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isStudent()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('You are not allowed to post tution.');
        }
        $tution = new Tution($request->all());
        $tution->student_id = Auth::user()->id;

        if ($tution->isInvalid()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not add Tution.', $tution->getErrors());
        }


        $errors = [];
        $answers = $request->get('answers', []);
        if (Question::tution()->count() != count($answers)) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not add Tution.', ['answers' => 'Invalid number of answers']);
        }
        $answers_save = [];
        foreach ($answers as $key => $answer) {
            $question_id = isset($answer['question_id']) ? $answer['question_id'] : null;
            $choice_id = isset($answer['choice_id']) ? $answer['choice_id'] : null;
//            $answer = Answer::updateOrCreate([
//                    'question_id' => $question_id,
//                    'choice_id' => $choice_id,
//                    'user_id' => Auth::user()->id,
//            ]);
//            $answer = Answer::find([
//                    'question_id' => $question_id,
//                    'user_id' => Auth::user()->id,
//                ])->first();
//            if (!$answer) {
            $answer = new Answer;
            $answer->question_id = $question_id;
//                $answer->user_id = Auth::user()->id;
//            }
            $answer->choice_id = $choice_id;
            if ($answer->isInvalid()) {
                $errors[] = $answer->getErrors()->getMessages();
            } else {
                $answers_save[] = $answer;
            }
        }
        if ($errors) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not add Tution.', $errors);
        }
        $tution->status = Tution::STATUS_NEW;
        $tution->save();
        if ($request->get('subjects')) {
            $tution->retag($request->get('subjects'));
        }
        $tution->answers()->saveMany($answers_save);
        $tution->answers;
        return $tution;
    }

    /**
     * Tution Information
     *
     * @Get("/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={})
     * })
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->isStudent()) {
            $student_id = $user->id;
            $relations = ['tutor', 'invitations.tutor'];
            $relations[] = 'proposals.tutor';
        }
        if ($user->isTutor()) {
            $tutor_id = $user->id;
            $relations = 'student';
        }
        $query = Tution::with($relations)
            ->whereKey($id);
        if ($user->isTutor()) {
//            $query->findTutor($user->id);
            $query->publicOnlyAndInvitedUser($user->id);
        } else {
            $query->findStudent($user->id);
        }
        
        $tution = $query->firstOrFail();
        return $tution;
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
        //
    }

    /**
     * Rate Tution by Student / Tutor
     * 
     * @Post("/{id}/rate")
     * 
     * @Parameters({
     *      @Parameter("rating", type="integer", description="value between 1-5", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"rating":"1"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"rating":{"rating":3,"reviews":null,"user_id":11,"rateable_type":"App\\Models\\Profile","rateable_id":6,"updated_at":"2017-04-29 10:45:56","created_at":"2017-04-29 10:45:56","id":1}}),
     *      @Response(422, body={"message":"Could not rate Tution.","errors":{"rating":{"You have already rated this tution."}},"status_code":422})
     * })
     */
    public function rate(Request $request, $id)
    {
        $user = Auth::user();
        $query = Tution::whereKey($id)
            ->status(Tution::STATUS_COMPLETED)
        ;
        if ($user->isTutor()) {
            $query->findTutor($user->id);
        } else {
            $query->findStudent($user->id);
        }
        $tution = $query->firstOrFail();
        if ($tution->userAverageRating) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not rate Tution.', ['rating' => 'You have already rated this tution.']);
        }
        $other_user = null;
        if ($user->isTutor()) {
            $other_user = $tution->student;
        } else {
            $other_user = $tution->tutor;
        }

        $rating = new Rating;
        $rating->rating = $request->get('rating', 1);
        $rating->reviews = $request->get('reviews', null);
        $rating->user_id = $user->id;

        if ($other_user) {
            $tution->ratings()->save($rating);
            $rating = new Rating;
            $rating->rating = $request->get('rating', 1);
            $rating->reviews = $request->get('reviews', null);
            $rating->user_id = $user->id;
            $other_user->ratings()->save($rating);
        }

        return $rating;
    }

    /**
     * Complete/Finished tution by Student / Tutor
     * 
     * @Post("/{id}/finished")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"rating":{"rating":3,"reviews":null,"user_id":11,"rateable_type":"App\\Models\\Profile","rateable_id":6,"updated_at":"2017-04-29 10:45:56","created_at":"2017-04-29 10:45:56","id":1}}),
     *      @Response(422, body={"message":"Could not rate Tution.","errors":{"rating":{"You have already rated this tution."}},"status_code":422})
     * })
     */
    public function finished(Request $request, $id)
    {
        $user = Auth::user();
        $query = Tution::whereKey($id)
            ->status(Tution::STATUS_INPROGRESS)
        ;
        if ($user->isTutor()) {
            $query->findTutor($user->id);
        } else {
            $query->findStudent($user->id);
        }
        $tution = $query->firstOrFail();
        $tution->status = Tution::STATUS_COMPLETED;
        $tution->save();
        return $tution;
    }
}
