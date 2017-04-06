<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use JWTAuth;
use Socialite;
use App\Models\User;
use App\Models\Profile;

/**
 * @Resource("Login", uri="/login" )
 */
class LoginController extends Controller
{

    /**
     * Generate JSON Web Token.
     */
    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    /**
     * Tutor Login with Google
     *
     * Login user with a google code.
     * Token is returned which will be required in every request
     *
     * @Post("/google/tutor")
     * 
     * @Transaction({
     *      @Request({"code":"4/7zE1BAw89p1hyBuVS1NCMjMVIVfHD81VIPo0PdFhpTU"}),
     *      @Response(200, body={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA","user":{"email":"user2@mailinator.com","created_at":"2017-04-03 07:29:40","id":2}}),
     *      @Response(401, body={ "error":"invalid_credentials","message":"Invalid credentials", "status_code": 401 }),
     *      @Response(401, body={ "error": "user_blocked", "message": "Your Account has been blocked.", "status_code": 401 }),
     *      @Response(500, body={ "error":"could_not_create_token","message":"Internal Server Error", "status_code": 500 })
     * })
     */
    public function google(Request $request, $user_type)
    {
        $provider_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('google', '=', $provider_user->getId())->first();

        if (!$user) {
            $user = new User;
            $user->email = $provider_user->getEmail();
            if ($user_type == 'tutor') {
                $user->user_type = User::TYPE_TUTOR;
            } else {
                $user->user_type = User::TYPE_STUDENT;
            }
            $user->google = $provider_user->getId();
            if ($user->isInvalid()) {
                throw new \Dingo\Api\Exception\ResourceException('Could not login user.', $user->getErrors());
            }
            $user->save();

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $provider_user->getName();
            $profile->avatar = $provider_user->getAvatar();
            $profile->save();
        }
//        if (($user_type == 'tutor' && $user->isTutor()) ||
//            ($user_type == 'student' && !$user->isStudent())) {
//            return response()->json(['error' => 'invalid_credentials',
//                    'message' => 'Invalid credentials', 'status_code' => 401], 401);
//        }
        if ($user->isBlocked()) {
            return response()->json(['error' => 'user_blocked',
                    'message' => 'Your Account has been blocked.', 'status_code' => 401], 401);
        }

        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token, 'user' => $user]);
    }

    /**
     * Student Login with Google
     *
     * Login user with a google code.
     * Token is returned which will be required in every request
     *
     * @Post("/google/student")
     * 
     * @Transaction({
     *      @Request({"code":"4/7zE1BAw89p1hyBuVS1NCMjMVIVfHD81VIPo0PdFhpTU"}),
     *      @Response(200, body={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cL2dhbmdzdGVyLXN0cmVuZ3RoLmxvY2FsXC9hcGlcL3VzZXJzXC9yZWdpc3RlciIsImlhdCI6MTQ5MTIwNDU4MSwiZXhwIjoxNDkxMjA4MTgxLCJuYmYiOjE0OTEyMDQ1ODEsImp0aSI6ImZiMzAxMzI1YzgyMmRiMzkxMzhmOTkzMjc0MDQ5NTk1In0.L2PcdY3kuUdakNzgWirglwuJqCTtdLa-uHaAfL5OZqA","user":{"email":"user2@mailinator.com","created_at":"2017-04-03 07:29:40","id":2}}),
     *      @Response(401, body={ "error":"invalid_credentials","message":"Invalid credentials", "status_code": 401 }),
     *      @Response(401, body={ "error": "user_blocked", "message": "Your Account has been blocked.", "status_code": 401 }),
     *      @Response(500, body={ "error":"could_not_create_token","message":"Internal Server Error", "status_code": 500 })
     * })
     */
    public function googleStudent()
    {
        
    }

    public function simple(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials',
                        'message' => 'Invalid credentials', 'status_code' => 401], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token',
                    'message' => 'Internal Server Error', 'status_code' => 500], 500);
        }
        $user = JWTAuth::toUser($token);
        return response()->json(['token' => $token, 'user' => $user]);
    }
}
