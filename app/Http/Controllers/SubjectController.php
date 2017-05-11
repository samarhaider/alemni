<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Subject;
use Auth;

/**
 * @Resource("Subject", uri="/subjects" )
 */
class SubjectController extends Controller
{

    /**
     * Subjects List
     *
     * @Get("/")
     * 
     * @Parameters({
     * })
     * 
     * @Transaction({
     *      @Response(200, body={"Maths","Science","Language","Test preparation","Elementary education","Computer","Business","History","Music","Special Needs","Sports\/Recreation","Religion","Art"})
     * })
     */
    public function index(Request $request)
    {
        return [
            'Maths',
            'Science',
            'Language',
            'Test preparation',
            'Elementary education',
            'Computer',
            'Business',
            'History',
            'Music',
            'Special Needs',
            'Sports/Recreation',
            'Religion',
            'Art',
        ];
    }
}
