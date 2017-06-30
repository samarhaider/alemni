<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Messenger;
use Gerardojbaez\Messenger\Models\Message;
use App\Models\User;

/**
 * @Resource("Messages", uri="/messages" )
 */
class MessageController extends Controller
{
}