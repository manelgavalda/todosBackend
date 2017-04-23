<?php

namespace ManelGavalda\TodosBackend\Http\Controllers;

use ManelGavalda\TodosBackend\Events\MessageSent;
use ManelGavalda\TodosBackend\Notifications\MessageSent as MessageSentNotification;
use ManelGavalda\TodosBackend\Message;
use Auth;
use Illuminate\Http\Request;

/**
 * Class MessagesController.
 *
 * @package ManelGavalda\TodosBackend\Http\Controllers
 */
class MessagesController extends TodosBaseController
{

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
//      $user = Auth::user();
        $user = $request->user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        //Broadcast

        broadcast(new MessageSent($user,$message))->toOthers();


        $user->notify(new MessageSentNotification($user,$message));



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