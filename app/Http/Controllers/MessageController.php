<?php

namespace App\Http\Controllers;

use App\MessageThread;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use function Sodium\compare;

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
            return redirect(url('messages/thread', $active_thread->id));
//            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function view_thread($thread_id){
        $threads = MessageThread::orderBy('id', 'desc')->get();
        if($thread_id != 0) {
            $active_thread = MessageThread::find($thread_id);
            Message::where('message_thread_id', $active_thread->id)->where('to_user_id', '=', Auth::id())->update(['read_at'=>now()]);
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return view('user-panel.chat.messages', compact( 'threads'));
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
            $threads = MessageThread::orderBy('id', 'desc')->get();
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $active_thread = MessageThread::orderBy('id', 'desc')->first();
            $threads = MessageThread::orderBy('id', 'desc')->get();
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
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

    public function read_all($thread_id){
        Message::where('message_thread_id', '=', $thread_id)->whereNull('read_at')->update(['read_at'=>now()]);
    }

    public function send(Request $request)
    {
        $message = new Message($request->all());
        $message->save();

//         pusher
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
//
        $data = ['from' => $request->sender, 'to' => $request->receiver,
            'message'=>$request->message, 'thread_id'=>$message->message_thread_id,
            'from_user_id'=>$request->from_user_id, 'to_user_id'=>$request->to_user_id];
        $pusher->trigger('my-channel', 'my-event', $data);
        $pusher->trigger('header-chat-notification', 'header-chat-notification-event', $data);

    }

}
