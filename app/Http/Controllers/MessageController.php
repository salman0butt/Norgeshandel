<?php

namespace App\Http\Controllers;

use App\MessageThread;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use function Sodium\compare;

class MessageController extends Controller
{
    public function new_thread($ad_id){
        $ad = Ad::find($ad_id);
        if(!empty($ad)) {
            $ad_threads = Auth::user()->threads->where('ad_id', $ad_id);
            if (is_countable($ad_threads) && count($ad_threads) > 0) {
                $active_thread = $ad_threads->first();
            } else {
                $active_thread = new MessageThread(['ad_id' => $ad_id]);
                $active_thread->save();
                $active_thread->users()->attach([Auth::id(), $ad->user->id]);
            }
            return redirect(url('messages/thread', $active_thread->id));
        }
        return redirect('forbidden');
    }

    public function view_thread($thread_id){
        $threads = Auth::user()->threads;
        $active_thread = MessageThread::find($thread_id);
        Message::where('message_thread_id', $active_thread->id)->where('to_user_id', '=', Auth::id())->update(['read_at'=>now()]);
        return view('user-panel.chat.messages', compact('active_thread', 'threads'));
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
            $threads = Auth::user()->threads;
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $active_thread = MessageThread::orderBy('id', 'desc')->first();
            $threads = Auth::user()->threads;
            return view('user-panel.chat.messages', compact('active_thread', 'threads'));
        }
        return redirect('forbidden');
    }

    public function read_all($thread_id){
        Message::where('message_thread_id', '=', $thread_id)->where('to_user_id', '=', Auth::id())->whereNull('read_at')->update(['read_at'=>now()]);
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
        $data = ['message'=>$request->message, 'thread_id'=>$message->message_thread_id,
            'from_user_id'=>$request->from_user_id, 'to_user_id'=>$request->to_user_id];
        $pusher->trigger('my-channel', 'my-event', $data);
        $pusher->trigger('header-chat-notification', 'header-chat-notification-event', $data);

    }

}
