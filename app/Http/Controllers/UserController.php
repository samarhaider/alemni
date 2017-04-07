<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile as Profile;
use Auth;

/**
 * @Resource("Users", uri="/users" )
 */
class UserController extends Controller
{

    public function index(Request $request)
    {
        $user_model = User::
            with('user_detail')->unblock()
            ->active();
        if (Auth::user()->isStudent()) {
            $user_model->tutors();
        }
        if (Auth::user()->isTutor()) {
            $user_model->students();
        }
        if (!Auth::user()->isAdmin()) {
            $radius = Auth::user()->user_profile->radius;
            $latitude = Auth::user()->user_profile->latitude;
            $longitude = Auth::user()->user_profile->longitude;
            $user_model->nearBy($latitude, $longitude, $radius);
//            $condition = "distance(:lat, :long, o.latitude, o.longitude, 'ME') <= :distance";
//            $user_model->whereRaw('orders.user_id = users.id');
        }
        if ($request->get('user_type')) {
            $user_model->where('user_type', '=', $request->get('user_type'));
        }
        $field = $request->get('field', 'created_at');
        $order = $request->get('order', 'desc');
        $user_model->orderBy($field, $order);
        return $user_model->paginate(20);
    }


    /**
     * Show My Account info
     *
     * @Get("/me")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"user":{"id":10,"email":"tanner.damore@example.com","created_at":"2017-04-05 18:40:47","profile":{"gender":"F","name":"Destinee Leannon","avatar":null,"latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"1.00","radius":"10588", "address": "test", "qualifications": {"MBA","BS"}}}})
     * })
     */
    public function show($id)
    {
        if ($id == 'me') {
            $id = Auth::user()->id;
        }
        $user = User::with('profile')->find($id);
//        $user->profile->getQualification();
        return $user;
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
     *      @Parameter("address"),
     *      @Parameter("qualifications", type="array", description="string array of qualification"),
     *      @Parameter("bio")
     * })
     * 
     * @Transaction({
     *      @Request({"gender":"F","name":"Destinee Leannon","avatar":null,"latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"1.00","radius":"10588", "address": "test", "qualifications": {"MBA","BS"}}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"gender":"F","name":"Destinee Leannon","avatar":null,"latitude":"-69.92557000","longitude":"-144.58138800","phone_number":"+1-548-519-6469","bio":"Saepe dicta velit vitae. Iste et voluptatem excepturi quia et tenetur doloremque. Recusandae totam id alias est tempore id qui. Cupiditate perferendis rerum natus dolore ipsum odio itaque. Vel fugiat eos vero.","hourly_rate":"1.00","radius":"10588", "address": "test", "qualifications": {"MBA","BS"}}),
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
        $profile_data = $request->only('name', 'gender', 'latitude', 'longitude', 'phone_number', 'bio', 'hourly_rate', 'radius');
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
}
