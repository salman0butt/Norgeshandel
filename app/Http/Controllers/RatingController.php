<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Notification;
use App\User;
use App\UserRatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class RatingController extends Controller
{

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
    }

    // list notifications
    public function ratings_list(){
        $ratings = UserRatingReview::where('to_user_id',Auth::id())->orderBy('id','DESC')->paginate(5);
        return view('user-panel.my-business.rating',compact('ratings'));
    }

    //Show more notifications
    public function show_more_ratings(Request $request){
        $user = User::find($request->user_id);
        $ratings = UserRatingReview::where('to_user_id',$request->user_id)->where('id','<',$request->last_id)->orderBy('id','DESC')->paginate(5);
        $view = view('user-panel.my-business.'.$request->view_title,compact('ratings','user'))->render();

        return response()->json(['html'=>$view]);
    }

    // ratings users
    public function ad_ratings($id){
        $ad = Ad::find($id);
        if($ad){
            if($ad->ad_type != 'job' && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin') || $ad->sold_to_user->first()->id == Auth::id())){
                return view('user-panel.my-business.myad_ratings',compact('ad'));
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }
    }


    // ratings users
    public function store_ratings($id,Request $request){
        $ad = Ad::find($id);
        $pusher = $this->pusher;
        if($ad){
            if($ad->ad_type != 'job' && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin') || $ad->sold_to_user->first()->id == Auth::id())){
                // When seller is posting an reviews and ratings
                if(Auth::id() == $ad->user_id){
                    $request->merge(['to_user_id'=>$ad->sold_to_user->first()->id,'from_user_id'=>Auth::id()]);
                    $review_user = 'seller';
                }

                //when buyers is posting an reviews and ratings
                if(Auth::id() != $ad->user_id && Auth::id() == $ad->sold_to_user->first()->id){
                    $request->merge(['to_user_id'=>$ad->user_id,'from_user_id'=>Auth::id()]);
                    $review_user = 'buyer';
                }


                $validatedData = $request->validate([
                    'to_user_id' => 'required',
                    'from_user_id' => 'required',
                    'communication_ratings' => 'required',
                    'delivery_ratings' => 'required',
                    'description_ratings' => 'required',
                    'payment_ratings' => 'required',
                    'general_ratings' => 'required',
                    'review' => 'required',
                ]);
                $rating = new UserRatingReview($request->all());
                $rating->ad_id = $ad->id;
                $rating->save();

                // Send notification to ratings receiver user
                $user_name = $rating->from_user && ($rating->from_user->first_name || $rating->from_user->last_name) ? $rating->from_user->first_name.' '.$rating->from_user->last_name : 'NH-Bruker';
                $notif = new Notification(['notifiable_type' => UserRatingReview::class, 'type' => 'ratings_reviews', 'user_id' => $rating->to_user_id, 'notifiable_id' => $rating->id, 'data' => $user_name.' har gitt deg sin vurdering.']);
                $notif->save();
                $data = array('detail' => 'Anmeldelse lagt ut', 'to_user_id' => $rating->to_user_id);
                $pusher->trigger('notification', 'notification-event', $data);

                //Send email notification to ratings receiver user
                $text = 'Vi vil informere deg om at '.$user_name.' har gitt deg sin vurdering. For å se dette, logg inn på NorgesHandel.';
                $subject = 'Du har mottatt en omtale.';

                $to_name = $rating->to_user->username;
                $user_obj = $rating->to_user;
                $to_email = $rating->to_user->email;
                Mail::send('mail.ratings_email_notification',compact('text','user_obj'), function ($message) use ($to_name, $to_email,$subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('developer@digitalmx.no', 'NorgesHandel');
                });

                Session::flash('success', 'Anmeldelsen har blitt lagt ut.');

                if($review_user == 'seller'){
                    return redirect(url('my-business/my-ads'));
                }

                if($review_user == 'buyer'){
                    return redirect(url('my-business/buy-ads'));
                }
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }
    }
}
