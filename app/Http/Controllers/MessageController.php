<?php

namespace App\Http\Controllers;

use App\MessageThread;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function new_thread($ad_id){
        if(Auth::check()) {
            $active_thread = MessageThread::where('ad_id', $ad_id)->where('user_id', Auth::id())->first();
            if (empty($active_thread)){
                $active_thread = new MessageThread(['user_id'=>Auth::id(), 'ad_id'=>$ad_id]);
                $active_thread->save();
            }
            $threads = MessageThread::all();
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function render_thread($thread_id){
        if(Auth::check()) {
            $thread = MessageThread::find($thread_id);
            $messages = $thread->messages;
            exit(view('common.partials.messages.index', compact('messages', 'thread'))->render());
        }
        else{
            return redirect('forbidden');
        }
    }

    public function show_thread($thread_id){
        if(Auth::check()) {
            $active_thread = MessageThread::find($thread_id);
            $threads = MessageThread::all();
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function index(Request $request)
    {
        //select all users except logged in user
        //$users = User::where('id', '!=', Auth::id())->get();

        $users = DB::select("select users.id, users.username, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.username, users.email");

        return view('user-panel.chat.messages',['users' => $users]);
    }

    public function get($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('common.partials.messages.index', ['messages' => $messages]);
    }


    public function send(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        //$pusher->trigger('my-channel', 'my-event', $data);

    }

}
