<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use Auth;

/**
 * @Resource("Answer", uri="/answers" )
 */
class AnswerController extends Controller
{

    /**
     * List of Answers of profile Questionnaires
     *
     * @Get("/")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"answers":{{"id":26,"questionable_id":"13","questionable_type":"App\\Models\\Profile","question_id":"2","choice_id":"4","created_at":"2017-04-12 18:58:10"},{"id":27,"questionable_id":"13","questionable_type":"App\\Models\\Profile","question_id":"5","choice_id":"2","created_at":"2017-04-12 18:58:10"},{"id":28,"questionable_id":"13","questionable_type":"App\\Models\\Profile","question_id":"9","choice_id":"4","created_at":"2017-04-12 18:58:10"},{"id":29,"questionable_id":"13","questionable_type":"App\\Models\\Profile","question_id":"11","choice_id":"2","created_at":"2017-04-12 18:58:10"},{"id":30,"questionable_id":"13","questionable_type":"App\\Models\\Profile","question_id":"13","choice_id":"5","created_at":"2017-04-12 18:58:10"}}})
     * })
     */
    public function index(Request $request)
    {
        $answers = Auth::user()->profile
                ->answers()->get();
        return $answers;
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
     * Add/Edit Answer of Profile Questionnaires
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("answers", type="array", description="array of objects", required=true)
     * })
     * @Transaction({
     *      @Request({"answers":{{"question_id": 1,"choice_id": 2},{"question_id": 4,"choice_id": 2},{"question_id": 6,"choice_id": 2},{"question_id": 8,"choice_id": 2},{"question_id": 12,"choice_id": 2}} }, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"answers":{{"id":21,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"1","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":22,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"4","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":23,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"6","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":24,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"8","choice_id":"2","created_at":"2017-04-12 17:32:21"},{"id":25,"questionable_id":"5","questionable_type":"App\\Models\\Tution","question_id":"12","choice_id":"2","created_at":"2017-04-12 17:32:22"}}}),
     *      @Response(422, body={"message":"Could not add answers.","errors":{"answers":{"Invalid number of answers"}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        $errors = [];
        $answers = $request->get('answers', []);
        $number_of_questions = 0;
        if (Auth::user()->isStudent()) {
            $number_of_questions = Question::student()->count();
        }
        if (Auth::user()->isTutor()) {
            $number_of_questions = Question::tutor()->count();
        }

        if ($number_of_questions != count($answers)) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not add answers.', ['answers' => 'Invalid number of answers']);
        }
        $answers_response = [];
        foreach ($answers as $key => $answer) {
            $question_id = isset($answer['question_id']) ? $answer['question_id'] : null;
            $choice_id = isset($answer['choice_id']) ? $answer['choice_id'] : null;
            $answer = Auth::user()->profile
                ->answers()
                ->where('question_id', $question_id)
                ->first();
            if (!$answer) {
                $answer = new Answer;
                $answer->question_id = $question_id;
            }
            $answer->choice_id = $choice_id;
            if ($answer->isInvalid()) {
                $errors[] = $answer->getErrors()->getMessages();
            } else {
                $answers_response[] = $answer;
            }
        }
        if ($errors) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not add answers.', $errors);
        }
        Auth::user()->profile->answers()->saveMany($answers_response);
        return $answers_response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->isAdmin()) {
            return;
        }
        $question = Answer::findOrFail($id);
        return $question;
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
