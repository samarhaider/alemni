<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Auth;

/**
 * @Resource("Question", uri="/questions" )
 */
class QuestionController extends Controller
{

    /**
     * List of Questionnaires with options
     *  
     * for student/tutor profile and tutions
     * 
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("type", type="integer", description="1=for tutions, 2= student, 3= tutor")
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"questions":{{"id":2,"text":"Duchess. 'Everything's got a moral, if only you.","choices":{{"id":6,"question_id":"2","text":"White Rabbit, with."},{"id":7,"question_id":"2","text":"What WILL become."},{"id":8,"question_id":"2","text":"Alice dodged."},{"id":9,"question_id":"2","text":"Cheshire Cat,'."},{"id":10,"question_id":"2","text":"Gryphon, and the."}}},{"id":5,"text":"Soup! Beau--ootiful Soo--oop! Beau--ootiful.","choices":{{"id":21,"question_id":"5","text":"THIS!' (Sounds of."},{"id":22,"question_id":"5","text":"Gryphon: and it."},{"id":23,"question_id":"5","text":"She is such a long."},{"id":24,"question_id":"5","text":"I beg your."},{"id":25,"question_id":"5","text":"White Rabbit read."}}},{"id":9,"text":"The Duchess took no notice of her or of anything.","choices":{{"id":41,"question_id":"9","text":"ME.' 'You!' said."},{"id":42,"question_id":"9","text":"Hatter added as an."},{"id":43,"question_id":"9","text":"Gryphon, and the."},{"id":44,"question_id":"9","text":"They had a door."},{"id":45,"question_id":"9","text":"I mean what I used."}}},{"id":11,"text":"It means much the most interesting, and perhaps.","choices":{{"id":51,"question_id":"11","text":"FIT you,' said the."},{"id":52,"question_id":"11","text":"YOUR table,' said."},{"id":53,"question_id":"11","text":"Alice. 'That's the."},{"id":54,"question_id":"11","text":"Duchess was."},{"id":55,"question_id":"11","text":"However,."}}},{"id":13,"text":"Though they were filled with cupboards and.","choices":{{"id":61,"question_id":"13","text":"I grow up, I'll."},{"id":62,"question_id":"13","text":"In another moment."},{"id":63,"question_id":"13","text":"Caterpillar took."},{"id":64,"question_id":"13","text":"Majesty,' said the."},{"id":65,"question_id":"13","text":"She pitied him."}}}}})
     * })
     */
    public function index(Request $request)
    {
        if (Auth::user()->isStudent()) {
            $user_type = Question::FOR_STUDENT;
        }
        if (Auth::user()->isTutor()) {
            $user_type = Question::FOR_TUTOR;
        }
        if ($request->get('type', false)) {
            $user_type = $request->get('type', false);
        }

        return Question::select(['id', 'text'])
//                ->with('choices')
                ->for($user_type)
                ->get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return;
        }
        $question = new Question;
        $question->text = $request->get('text');
        $question->user_type = $request->get('user_type');
        if (!$question->save()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update question.', $question->getErrors());
        }
        return $question;
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
        $question = Question::findOrFail($id);
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
        if (!Auth::user()->isAdmin()) {
            return;
        }
        $question = Question::findOrFail($id);
        $question->text = $request->get('text');
        $question->user_type = $request->get('user_type');
        if (!$question->save()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update question.', $question->getErrors());
        }
        return $question;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            return;
        }
        $question = Question::findOrFail($id);
        if (!$question->delete()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not delete question.', $question->getErrors());
        }
        return $question;
    }
}
