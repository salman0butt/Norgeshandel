<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Jobs\JobController;
use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use App\User;
use function GuzzleHttp\Psr7\str;


class NotificationController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        $searches = Auth::user()->saved_searches;
        return view('common.partials.notifications.all_notifications', compact('searches'));
    }

    public function notifications_count(){
        $count = 0;
        $searches = Auth::user()->saved_searches;
        foreach ($searches as $search){
            if($search->unread_notifications && count($search->unread_notifications)>0){
                $count++;
            }
        }
        return $count;
    }

    public function create($notifiable_id, $property_type, $text)
    {
        $notification_data = array();
        $notification_data['type'] = $property_type;
        $notification_data['user_id'] = Auth::user()->id;
        $notification_data['notifiable_id'] = $notifiable_id;
        $notification_data['data'] = $text;
        $response = Notification::create($notification_data);
        return $response;
    }

    public function getAllNotifications()
    {

        $data['count'] = "";
        $data['html'] = "";
        if (User::find(Auth::user()->id)->is('admin')) {
            $notifications = Notification::where('user_id', '!=', Auth::user()->id)->where('read_at', '=', null)->get()->toArray();
            $count = count($notifications);
            $html = "";
            foreach ($notifications as $key => $val) {
                $html .= "<input type='hidden' name='notids[]' value='" . $val['notifiable_id'] . "'>";
            }
            $data['count'] = $count;
            $data['html'] = $html;
        } else {
            $notifications = Notification::join('searches', 'notifications.type', '=', 'searches.ad_type')
                ->where('notifications.user_id', '!=', Auth::user()->id)
                ->where('searches.user_id', '=', Auth::user()->id)
                ->where('notifications.read_at', '=', null)
                ->groupBy('notifications.id')
                ->get([
                    'notifications.notifiable_id'
                ])->toArray();
            $count = count($notifications);
            $html = "";
            foreach ($notifications as $key => $val) {
                $html .= "<input type='hidden' name='notids[]' value='" . $val['notifiable_id'] . "'>";
            }
            $data['count'] = $count;
            $data['html'] = $html;

        }


        echo json_encode($data);
    }

    public function read_all(){
        $notifications = Auth::user()->unread_notifications();
        $notifications->update(['read_at'=>now()]);
        return redirect()->back();
    }

    public function showAllNotifications(Request $request)
    {
        if (User::find(Auth::user()->id)->is('admin')) {
            $ids = Notification::where('user_id', '!=', Auth::user()->id)->get(['notifiable_id', 'id'])->toArray();
        } else {
            $ids = Notification::join('searches', 'notifications.type', '=', 'searches.ad_type')
                ->where('notifications.user_id', '!=', Auth::user()->id)
                ->where('searches.user_id', '=', Auth::user()->id)
                ->where('notifications.read_at', '=', null)
                ->groupBy('notifications.id')
                ->get([
                    'notifications.id as id',
                    'notifications.notifiable_id as notifiable_id'
                ])->toArray();
        }
        return view('common.partials.notifications.all_notifications', ['ids' => $ids]);

    }

    public function searchNotificationExists(Request $request)
    {
        $data = $request->all();
        $notification_id = $data['ma'];
        $ids = Notification::join('searches', 'notifications.type', '=', 'searches.ad_type')
            ->where('notifications.id', '=', $data['ma'])
            ->where('searches.user_id', '=', Auth::user()->id)
            ->where('notifications.read_at', '=', null)
            ->groupBy('notifications.id')
            ->get([
                'notifications.id as id',
                'notifications.notifiable_id as notifiable_id'
            ])->toArray();
        if (count($ids) > 0) {
            $data["res"] = true;
        } else {
            $data["res"] = false;
        }

        echo json_encode($data);
    }


}
