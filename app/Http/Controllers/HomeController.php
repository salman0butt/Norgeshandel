<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Model\Search;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $saved_search = Search::where('type', 'saved')->orderBy('id', 'desc')->limit(5)->get();
        $recent_search = Search::where('type', 'recent')->orderBy('id', 'desc')->limit(5)->get();

        $ads = Ad::where('status', 'published')->orderBy('id', 'desc')->get();
        return view('home', compact('ads','saved_search','recent_search'));
        
    }
    public function home() {

        $saved_search = Search::where('type', 'saved')->orderBy('id', 'desc')->limit(5)->get();
        $recent_search = Search::where('type', 'recent')->orderBy('id', 'desc')->limit(5)->get();


        $ads = Ad::where('status', 'published')->orderBy('id', 'desc')->get();
       return view('home', compact('ads','saved_search','recent_search'));
    }
}
