<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    //
    public function __construct()
    {
        
    }

    public function create($notifiable_id,$property_type,$text)
    {
        $notification_data = array();
        $notification_data['type']          = $property_type;
        $notification_data['user_id']       = Auth::user()->id;
        $notification_data['notifiable_id'] = $notifiable_id;
        $notification_data['data']          = $text;
        $response                           = Notification::create($notification_data);
        return $response;
    }

    public function getAllNotifications(){
        
        $notifications = Notification::where('read_at','=',null)->get()->toArray();
        $count = count($notifications);
        $html = "";
        foreach($notifications as $key=>$val)
        {
            $html .= "<input type='hidden' name='notids[]' value='".$val['notifiable_id']."'>";
        }
        $data['count'] = $count;
        $data['html']  = $html;

        echo json_encode($data);
    }


    public function showAllNotifications(Request $request)
    {
        $ids = Notification::get(['notifiable_id'])->toArray();
        return view('common.partials.notifications.all_notifications', ['ids' => $ids]);

    }

}
