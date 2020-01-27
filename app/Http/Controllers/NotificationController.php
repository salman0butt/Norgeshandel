<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use App\User;


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
        
        if(User::find(Auth::user()->id)->is('admin'))
        {
            $notifications = Notification::where('user_id','!=',Auth::user()->id)->where('read_at','=',null)->get()->toArray();
            $count = count($notifications);
            $html = "";
            foreach($notifications as $key=>$val)
            {
                $html .= "<input type='hidden' name='notids[]' value='".$val['notifiable_id']."'>";
            }
            $data['count'] = $count;
            $data['html']  = $html;
        }
        else
        {
            $data['count'] = "";
            $data['html']  = "";
        }
        

        echo json_encode($data);
    }


    public function showAllNotifications(Request $request)
    {
        $ids = Notification::where('user_id','!=',Auth::user()->id)->get(['notifiable_id','id'])->toArray();
        return view('common.partials.notifications.all_notifications', ['ids' => $ids]);

    }

}
