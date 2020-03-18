<?php

namespace App\Http\Controllers;

use App\Helpers\common;
use App\Media;
use App\MessageThread;
use App\Models\Ad;
use Illuminate\Support\Facades\Session;
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
        if($ad) {
            $ad_threads = Auth::user()->threads()->where('ad_id', $ad_id)->get();
            if (is_countable($ad_threads) && count($ad_threads) > 0) {
                $active_thread = $ad_threads->first();
            } else {
                $active_thread = new MessageThread(['ad_id' => $ad_id]);
                $active_thread->save();
                $active_thread->users()->attach([Auth::id(), $ad->user->id]);
            }
//            return redirect(url('messages/thread', $active_thread->id));
            $new_id = $active_thread->id;
            return $this->view_thread($active_thread->id, $new_id);
        }
        else{
            return redirect('forbidden');
        }
    }

    public function view_thread($thread_id, $new_id = 0){
        $threads = Auth::user()->threads;
        $active_thread = MessageThread::find($thread_id);
        Message::where('message_thread_id', $active_thread->id)->where('to_user_id', '=', Auth::id())->update(['read_at'=>now()]);
        return view('user-panel.chat.messages', compact('active_thread', 'threads', 'new_id'));
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
        $message = new Message($request->except(['form', 'attachment']));
        $message->save();
        if($request->attachment){
            common::update_media($request->attachment, $message->id, Message::class, 'attachment', true, false);
        }

//         pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
//            950445,
            $options
        );
//        dd(env('PAGINATION'));
//        dd($pusher);
//
        $files = array();
        $media = $message->media;
        if (count($media)>0){
            foreach ($media as $file){
                $name = $file->name;
                $path = common::getMediaPath($file);
                array_push($files, ['name'=>$name, 'path'=>$path]);
            }
        }
        $ad_img_src = asset('public/images/placeholder.png');
        $ad_title = '';
        $last_message_date = '';
        if($message->message_thread_id){
            $message_thread = MessageThread::find($message->message_thread_id);
            if($message_thread){

                // Get title of an ad
                if($message_thread->ad){
                    $ad_title = $message_thread->ad->getTitle();
                }

                // Get date of last message
                if($message_thread->messages->last()){
                    $last_message_date = $message_thread->messages->last()->created_at->format('d.m.Y');
                }

                // Get image of ad
                if(is_countable($message_thread->ad->company_gallery) && count($message_thread->ad->company_gallery) > 0){
                    $ad_img_src = asset(\App\Helpers\common::getMediaPath($message_thread->ad->company_gallery->first()),"150x150");
                }
            }
        }
        $data = ['message'=>$request->message, 'thread_id'=>$message->message_thread_id,
            'ad_img_src'=>$ad_img_src,'ad_title'=>$ad_title,'last_message_date'=>$last_message_date,
            'from_user_id'=>$request->from_user_id, 'to_user_id'=>$request->to_user_id, 'files'=>$files];
        $pusher->trigger('my-channel', 'my-event', $data);
        $pusher->trigger('header-chat-notification', 'header-chat-notification-event', $data);

        exit(json_encode($data));
    }

    public function delete_thread($thread_id){
        $thread = Auth::user()->threads->where('id', '=', $thread_id)->first();
        if($thread){
            $deleted_messages = $thread->one_side_messages;
            $ids = $deleted_messages->pluck('id');
            Message::whereIn('id', $ids)->delete();
            $media = Media::whereIn('mediable_id', $ids)->get();
            foreach ($media as $file){
                common::delete_media($file->mediable_id, $file->mediable_id, $file->type);
            }
            Media::whereIn('id', $media->pluck('id'))->delete();
            $ids = $thread->messages->pluck('id');
            Message::whereIn('id', $ids)->update(['deleted_by'=>Auth::id()]);
        }
        Session::flash('success', 'Samtalen ble slettet');
        return redirect(url('/messages'));
//        return back();
    }

}
