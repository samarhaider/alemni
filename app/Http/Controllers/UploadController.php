<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Answer;
use Auth;
use File;
use Imageupload;
use Hash;
use JWTAuth;

/**
 * @Resource("Images", uri="/uploads" )
 */
class UploadController extends Controller
{

    /**
     * Upload Images
     *
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("attachments", "type"=array, required=true)
     * })
     * 
     * @Transaction({
     *      @Response(200, body={"attachments/m5YVZqMJagSdoUxalVFe5CYfPVmhPOvjFPgLlkkt.txt","attachments/hMdyme9xiDBmN577nuDiGo4o5qGs8qtI3YsqdMCj.html"}),
     *      @Response(422, body={"message":"Could not upload attachments.","errors":{"attachments":{"Attachments is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('attachments')) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not upload attachments.', ['attachments' => 'Attachments is required.']);
        }
        $paths = [];
        foreach ($request->file('attachments') as $key => $attachment) {
            $paths[] = 'uploads/'.$attachment->storePublicly('attachments', ['disk' => 'uploads']);
        }
        return $paths;
    }
}
