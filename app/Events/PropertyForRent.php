<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class PropertyForRent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $notification_id = "";
    public $user_id = "";
    public $notification_id_search = "";
    public $path = "";


    public function __construct($notification_id,$notification_id_search)
    {
        //
        $this->notification_id = $notification_id;
        
        $this->user_id = Auth::user()->id;
        $this->notification_id_search = $notification_id_search;
        $this->path =  url('search/notification/exists');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return ['property-for-rent'];
    }
    public function broadcastAs()
    {
        return 'property-for-rent';
    }
}
