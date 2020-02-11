<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Model\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $saved_search = null;
        $recent_search = null;
        if (Auth::check()) {
            $saved_search = Search::where('type', 'saved')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
            $recent_search = Search::where('type', 'recent')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
        }
        $ads = Ad::where('status', 'published')->orderBy('id', 'desc')->get();
        return view('home', compact('ads', 'saved_search', 'recent_search'));
    }

    //clear search history
    public function clearSearches(Request $request){
        $flag = '';
        if($request->type){
            $searches = Search::where('type', $request->type)->where('user_id', Auth::user()->id);
            if($searches->count() > 0){
                $searches->delete();
                $flag = 'success';
                return json_encode($flag);
                exit();
            }
        }
        return json_encode($flag);
        exit();
    }
}
