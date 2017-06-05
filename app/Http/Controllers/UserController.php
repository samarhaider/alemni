<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Answer;
use Auth;
use File;
use Imageupload;
use Hash;
use JWTAuth;
use App\Models\PasswordReset;
use App\Mail\PasswordResetCode;

/**
 * @Resource("Users", uri="/users" )
 */
class UserController extends Controller
{

    /**
     * List of tutors
     *
     * @Get("/")
     * 
     * @Parameters({
     *      @Parameter("latitude", type="decimal"),
     *      @Parameter("longitude", type="decimal"),
     *      @Parameter("radius", type="integer", description="Radius in meters"),
     *      @Parameter("qualifications", type="array", description="string array of qualification")
     * })
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"total":8,"per_page":1,"current_page":1,"last_page":8,"next_page_url":"http:\/\/localhost:8000\/api\/users?page=2","prev_page_url":null,"from":1,"to":1,"data":{{"id":1,"gender":"M","name":"Maye Klocko","avatar":null,"latitude":"40.53965400","longitude":"36.50458600","phone_number":"383-672-5171 x714","bio":"Occaecati incidunt doloremque id rerum incidunt tempora. Dolore tempore recusandae sequi commodi. Repellendus dolorem ea iusto quidem. Quis assumenda et eveniet.","hourly_rate":"10.00","radius":"4580", "experience": "1","email":"doyle.freddie@example.org","qualifications":{},"teaches":"Matric","specialist":"Maths","average_rating":"3.0000"}}})
     * })r
     */
    public function index(Request $request)
    {

//        $fields = ["id", "gender", "name", "avatar", "latitude", "longitude", "phone_number", "bio", "hourly_rate", "radius", "email", "qualifications"];
        $profile_model = Profile::
            join('users', function($join) {
                $join->on('users.id', '=', 'profiles.user_id');
            })
            ->unblock()
            ->active();
        if (Auth::user()->isStudent()) {
            $profile_model->tutors();
        }
        if (Auth::user()->isTutor()) {
            $profile_model->students();
        }
        if ($request->get('user_type')) {
            $profile_model->where('user_type', '=', $request->get('user_type'));
        }
        if ($request->get('gender')) {
            $profile_model->gender($request->get('gender'));
        }
        $latitude = $request->get('latitude', false);
        $longitude = $request->get('longitude', false);
        $distance = $request->get('radius', 5000);
        if ($latitude && $longitude) {
            $profile_model->nearBy($latitude, $longitude, $distance);
        }
        $qualifications = $request->get('qualifications', []);
        if (count($qualifications)) {
            $profile_model->withAnyTag($qualifications);
        }
//        $profile_model->latest();
        return $profile_model->paginate(20);
    }

    public function store(Request $request, $user_type)
    {
        $user = new User;
        $user->emailPasswordValidation();
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->user_type = $user_type;
        if ($user->isInvalid()) {
            throw new \Dingo\Api\Exception\ResourceException("Could not register {$user_type}.", $user->getErrors());
        }
        $user->password = Hash::make($user->password);
        $user->save();

        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->name = $request->get('name');
//            $profile->avatar = $provider_user->getAvatar();
        $profile->save();

        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token, 'user' => $user]);
    }

    /**
     * Register Student
     *
     * @Post("/register/student")
     * 
     * @Parameters({
     *      @Parameter("email", description="Student Email address", required=true),
     *      @Parameter("password", description="Password", required=true),
     *      @Parameter("name", description="Student Name")
     * })
     * 
     * @Transaction({
     *      @Request({"email": "tlabadie1@example.com", "password": "123456"}),
     *      @Response(200, body={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA","user":{"email":"user2@mailinator.com","created_at":"2017-04-03 07:29:40","id":2}}),
     *      @Response(422, body={"message":"Could not register student.","errors":{"email":{"The email has already been taken."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not register student.","errors":{"email":{"The email has already been taken."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not register student.","errors":{"email":{"The email must be a valid email address."}},"status_code":422})
     * })
     * 
     */
    public function student(Request $request)
    {
        return $this->store($request, User::TYPE_STUDENT);
    }

    /**
     * Register Tutor
     *
     * @Post("/register/tutor")
     * 
     * @Parameters({
     *      @Parameter("email", description="Tutor Email address", required=true),
     *      @Parameter("password", description="Password", required=true),
     *      @Parameter("name", description="Tutor Name", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"email": "tlabadie1@example.com", "password": "123456"}),
     *      @Response(200, body={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA","user":{"email":"user2@mailinator.com","created_at":"2017-04-03 07:29:40","id":2}}),
     *      @Response(422, body={"message":"Could not register tutor.","errors":{"email":{"The email has already been taken."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not register tutor.","errors":{"email":{"The email has already been taken."}},"status_code":422}),
     *      @Response(422, body={"message":"Could not register tutor.","errors":{"email":{"The email must be a valid email address."}},"status_code":422})
     * })
     * 
     */
    public function tutor(Request $request)
    {
        return $this->store($request, User::TYPE_TUTOR);
    }

    /**
     * Show My Account info
     *
     * @Get("/me")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"user":{"id":11,"email":"cleta71@example.net","user_type":"2","created_at":"2017-04-06 05:28:03","profile":{"id":13,"gender":"M","name":"Sam","avatar":"uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"12.00","radius":"5000", "experience": "1","qualifications":{"Mba","Bs"},"stage_complete":1,"teaches":"Matric","specialist":"Maths","average_rating":"3.0000","avatar_url":"http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","answers":{{"id":1,"questionable_id":"13","question_id":"1","text":"IT\/CS","created_at":"2017-05-04 05:39:51"},{"id":2,"questionable_id":"13","question_id":"2","text":"A1","created_at":"2017-05-04 05:39:51"},{"id":3,"questionable_id":"13","question_id":"3","text":"4","created_at":"2017-05-04 05:39:51"},{"id":4,"questionable_id":"13","question_id":"4","text":"2","created_at":"2017-05-04 05:39:52"},{"id":5,"questionable_id":"13","question_id":"5","text":"Samar","created_at":"2017-05-04 05:39:52"},{"id":6,"questionable_id":"13","question_id":"6","text":"Test","created_at":"2017-05-04 05:39:52"},{"id":7,"questionable_id":"13","question_id":"7","text":"Test one of these","created_at":"2017-05-04 05:39:52"}}}}})
     * })
     */
    public function show($id)
    {
        if ($id == 'me') {
            $id = Auth::user()->id;
        }
        $user = User::with('profile')->find($id);
        if ($user->id == Auth::user()->id) {
            $user->profile->answers;
            $user->creditCard;
        }
        $user->profile->ratings;
        $user->profile->averageRating;
        return $user;
    }

    /**
     * Show User profile
     *
     * @Get("/{id}")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"user":{"id":11,"email":"cleta71@example.net","user_type":"2","created_at":"2017-04-06 05:28:03","profile":{"id":13,"gender":"M","name":"Sam","avatar":"uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"12.00","radius":"5000", "experience": "1","qualifications":{"Mba","Bs"},"stage_complete":1,"teaches":"Matric","specialist":"Maths","average_rating":"3.0000","avatar_url":"http:\/\/localhost:8000\/uploads\/avatars\/T97YUzBN9pSizFPBAuZGmps3DdEybgn6wf03c1mk.jpeg","answers":{{"id":1,"questionable_id":"13","question_id":"1","text":"IT\/CS","created_at":"2017-05-04 05:39:51"},{"id":2,"questionable_id":"13","question_id":"2","text":"A1","created_at":"2017-05-04 05:39:51"},{"id":3,"questionable_id":"13","question_id":"3","text":"4","created_at":"2017-05-04 05:39:51"},{"id":4,"questionable_id":"13","question_id":"4","text":"2","created_at":"2017-05-04 05:39:52"},{"id":5,"questionable_id":"13","question_id":"5","text":"Samar","created_at":"2017-05-04 05:39:52"},{"id":6,"questionable_id":"13","question_id":"6","text":"Test","created_at":"2017-05-04 05:39:52"},{"id":7,"questionable_id":"13","question_id":"7","text":"Test one of these","created_at":"2017-05-04 05:39:52"}}}}})
     * })
     */
    public function viewprofile($id)
    {
        
    }

    /**
     * Update My Profile Information
     *
     * @Post("/me")
     * 
     * @Parameters({
     *      @Parameter("name", description="Customer Name"),
     *      @Parameter("gender", description="Gender is M/F"),
     *      @Parameter("latitude", type="decimal"),
     *      @Parameter("longitude", type="decimal"),
     *      @Parameter("phone_number"),
     *      @Parameter("hourly_rate", type="decimal"),
     *      @Parameter("radius", type="integer", description="Radius in meters"),
     *      @Parameter("experience", type="integer", description="Experience in Years"),
     *      @Parameter("address"),
     *      @Parameter("stage_complete", type="integer"),
     *      @Parameter("teaches"),
     *      @Parameter("specialist"),
     *      @Parameter("qualifications", type="array", description="string array of qualification"),
     *      @Parameter("bio")
     * })
     * 
     * @Transaction({
     *      @Request({"gender":"F","name":"Destinee Leannon","avatar":null,"latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"1.00","radius":"10588", "experience": "1", "address": "test", "qualifications": {"MBA","BS"},"stage_complete":1,"teaches":"Matric","specialist":"Maths","average_rating":"3.0000"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"gender":"F","name":"Destinee Leannon","avatar":null,"latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"1.00","radius":"10588", "experience": "1", "address": "test", "qualifications": {"MBA","BS"},"teaches":"Matric","specialist":"Maths","average_rating":"3.0000"}),
     *      @Response(422, body={"message":"Could not update user profile information.","errors":{"message":"Could not update user profile information.","errors":{"latitude":{"The latitude format is invalid."},"longitude":{"The longitude format is invalid."}},"status_code":422}})
     * })
     */
    public function update(Request $request, $id)
    {
        if ($id == 'me' || Auth::user()->isAdmin()) {
            $id = Auth::user()->id;
        }
        $user = User::with('profile')->findOrFail($id);
        $profile = $user->profile;
//        $profile_data = $request->only('name', 'gender', 'latitude', 'longitude', 'phone_number', 'bio', 'hourly_rate', 'radius', 'experience', 'address');
        $profile_data = $request->all();
        $profile->fill($profile_data);
        $qualifications = $request->get('qualifications', []);
        $profile->retag($qualifications);
        if (!$profile->save()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update user profile information.', $profile->getErrors());
        }
        return $profile;
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
     * Upload User Avatar
     *
     * @Post("/avatar")
     * 
     * @Parameters({
     *      @Parameter("avatar", description="This request is not Json based. So, please be careful before using it", required=true)
     * })
     * 
     * @Transaction({
     *      @Response(200, body={"profile":{"id":13,"gender":"M","name":"Sam","avatar":"uploads/avatars/P2ehhNLyHx53dpY1ve6wYT6Tl5exCzYPYfCtnKA4.jpeg","latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"12.00","radius":"5000", "experience": "1","qualifications":{"Mba","Bs"}}}),
     *      @Response(422, body={"message":"Could not update user avatar.","errors":{"errors":{"avatar":"The avatar field is required."}},"status_code":422})
     * })
     */
    public function avatar(Request $request)
    {
        $profile = Auth::user()->profile;
        if ($request->hasFile('avatar')) {
            $image_upload = Imageupload::upload($request->file('avatar'));
            $old_avatar = $profile->avatar;
            if ($image_upload['dimensions']['square250']) {
                $profile->avatar = $image_upload['dimensions']['square250']['filedir'];
            } else {
                $path = $request->file('avatar')->storePublicly('avatars', ['disk' => 'uploads']);
                $profile->avatar = 'uploads' . DIRECTORY_SEPARATOR . $path;
            }
            if ($profile->save()) {
                File::delete($old_avatar);
            }
            return $profile;
        }
        throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update user avatar.', ['errors' => ['avatar' => "The avatar field is required."]]);
    }

    /**
     * List of Answers of profile Questionnaires
     *
     * @Get("/questionnaires")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"answers":{{"id":1,"questionable_id":"13","question_id":"1","text":"IT\/CS","created_at":"2017-05-04 05:39:51"},{"id":2,"questionable_id":"13","question_id":"2","text":"A1","created_at":"2017-05-04 05:39:51"},{"id":3,"questionable_id":"13","question_id":"3","text":"4","created_at":"2017-05-04 05:39:51"},{"id":4,"questionable_id":"13","question_id":"4","text":"2","created_at":"2017-05-04 05:39:52"},{"id":5,"questionable_id":"13","question_id":"5","text":"Samar","created_at":"2017-05-04 05:39:52"},{"id":6,"questionable_id":"13","question_id":"6","text":"Test","created_at":"2017-05-04 05:39:52"},{"id":7,"questionable_id":"13","question_id":"7","text":"Test one of these","created_at":"2017-05-04 05:39:52"}}}),
     * })
     */
    public function questionnairesList(Request $request)
    {
        $answers = Auth::user()->profile
                ->answers()->get();
        return $answers;
    }

    /**
     * Add/Edit Answer of Profile Questionnaires
     * 
     * @Post("/questionnaires")
     * 
     * @Parameters({
     *      @Parameter("answers", type="array", description="array of objects", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"answers": {{"question_id":1, "text":"IT/CS"},{"question_id":2,"text":"A1"},{"question_id":3,"text":4},{"question_id":4,"text":2},{"question_id":5,"text":"Samar"},{"question_id":6,"text": "Test"},{"question_id":7,"text": "Test one of these"}}}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"answers":{{"id":1,"questionable_id":"13","question_id":"1","text":"IT\/CS","created_at":"2017-05-04 05:39:51"},{"id":2,"questionable_id":"13","question_id":"2","text":"A1","created_at":"2017-05-04 05:39:51"},{"id":3,"questionable_id":"13","question_id":"3","text":"4","created_at":"2017-05-04 05:39:51"},{"id":4,"questionable_id":"13","question_id":"4","text":"2","created_at":"2017-05-04 05:39:52"},{"id":5,"questionable_id":"13","question_id":"5","text":"Samar","created_at":"2017-05-04 05:39:52"},{"id":6,"questionable_id":"13","question_id":"6","text":"Test","created_at":"2017-05-04 05:39:52"},{"id":7,"questionable_id":"13","question_id":"7","text":"Test one of these","created_at":"2017-05-04 05:39:52"}}}),
     *      @Response(422, body={"message":"Could not add answers.","errors":{"answers":{"Invalid number of answers"}},"status_code":422})
     * })
     * 
     */
    public function updateQuestionnaires(Request $request)
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
//            $choice_id = isset($answer['choice_id']) ? $answer['choice_id'] : null;
            $text = isset($answer['text']) ? $answer['text'] : null;
            $answer = Auth::user()->profile
                ->answers()
                ->where('question_id', $question_id)
                ->first();
            if (!$answer) {
                $answer = new Answer;
                $answer->question_id = $question_id;
            }
//            $answer->choice_id = $choice_id;
            $answer->text = $text;
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
        return Auth::user()->profile->answers;
    }

    /**
     * Change Password
     * 
     * @Post("/change-password")
     * 
     * @Parameters({
     *      @Parameter("current_password", required=true),
     *      @Parameter("new_password", required=true)
     * })
     * 
     * @Transaction({
     *      @Request({"current_password": "new_password", "new_password": "123456"}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"user":{"id":15,"email":"student2@mailinator.com","user_type":"2","created_at":"2017-04-27 18:01:32"}}),
     *      @Response(422, body={"message":"Could not update password.","errors":{"current_password":{"Current password is not matched"}},"status_code":422})
     * })
     * 
     */
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        $user->changePasswordValidation();
        $hashedPassword = $user->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user->current_password = $request->current_password;
            $user->new_password = $request->new_password;
            //Change the password
            $user->fill([
                'password' => Hash::make($request->new_password)
            ]);
            if ($user->isInvalid()) {
                throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update password.', $user->getErrors());
            }
            $user->changePasswordValidation(false);
            unset($user->current_password);
            unset($user->new_password);
            $user->save();
            return $user;
        }

        $errors = [
            'current_password' => 'Current password is not matched',
        ];
        throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update password.', $errors);
    }
}
