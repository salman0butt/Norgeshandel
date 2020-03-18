<?php

namespace App\Http\Controllers\Property;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddRealEstateBusinessPlot;
use App\RealestateBusinessPlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class RealestateBusinessPlotController extends Controller
{
    //
    private $pagination;
    private $pusher;

    public function __construct()
    {
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $this->pagination = getenv('PAGINATION');
        $this->pagination = $this->pagination == 0 ? 30 : $this->pagination;
    }
}
