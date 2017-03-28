<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Notifications\MessageSent as MessageSentNotification;
use App\Message;
use Auth;
use Illuminate\Http\Request;
use Log;

/**
 * Class MessagesController.
 *
 * @package App\Http\Controllers
 */
class MessagesController extends TodosBaseController
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('messages',$data);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     *
     * @return array
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        //Broadcast

        broadcast(new MessageSent($user,$message))->toOthers();

        Log::debug('Before notify');

        $user->notify(new MessageSentNotification($user,$message));

        Log::debug('After notify');


        return ['status' => 'Message Sent!'];
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        //Lazy loading -> Eager Loading
        return Message::with('user')->get();
    }
}