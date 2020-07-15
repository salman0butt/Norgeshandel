<?php

namespace App\Http\Controllers;

use App\fav_list;
use App\Favorite;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->remove_trash();
        if (Auth::check()){
            $lists = fav_list::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            if (count($lists)<1){
                $list = new fav_list(['name'=>'Mine funn', 'user_id'=> Auth::user()->id, 'share_link'=>Str::random()]);
                $list->save();
                $lists = fav_list::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            }
            return view('user-panel.my-business.favorites.my_favorites_categories', compact('lists'));
        }
    }
    public function get_favorites()
    {
        $this->remove_trash();
        if (Auth::check()){
            $lists = fav_list::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            if (count($lists)<1){
                $list = new fav_list(['name'=>'Mine funn', 'user_id'=> Auth::user()->id, 'share_link'=>Str::random()]);
                $list->save();
                $lists = fav_list::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            }
            $list_view = "";
            foreach ($lists as $list){
                $list_view.= view('user-panel.partials.templates.fav-list', compact('list'))->render();
            }
            return $list_view;
        }
    }

    public function add_list($name){
        $this->remove_trash();
        if (Auth::check() && !empty($name)) {
            $list = new fav_list(['name' => $name, 'user_id' => Auth::user()->id, 'share_link'=>Str::random()]);
            $list->save();
        }
    }

    public function delete_list($list_id){
        $this->remove_trash();
        $list = fav_list::where('id', $list_id)->get()->first();
        Favorite::where('list_id', $list_id)->delete();
        $list->delete();
    }

    public function add_fav($list_id, $ad_id){
        $fav = Favorite::where(['ad_id'=>$ad_id, 'user_id'=>Auth::user()->id])->first();

        if(!$fav){
            $fav = new Favorite();
            $fav->ad_id = $ad_id;
            $fav->list_id = $list_id;
            $fav->user_id = Auth::user()->id;
            $fav->save();
        }
    }

    public function remove_fav($ad_id){
        $this->remove_trash();
        if(Auth::check()){
            Favorite::where(['ad_id'=>$ad_id, 'user_id'=>Auth::user()->id])->delete();
        }
    }

    public function rename_list($list_id, $name){
        $this->remove_trash();
        $list = fav_list::where('id', $list_id)->get()->first();
        $list->update(['name'=>$name]);
    }

    public function remove_trash(){
        Favorite::where('ad_id', 0)->delete();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->remove_trash();
        $fav = new Favorite();
        $fav->ad_id = $request->ad_id;
        $fav->user_id = Auth::user()->id;
        $fav->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }



    public function new_favorite($ad_id, $list){
        $this->remove_trash();
        $fav = new Favorite();
        $fav->ad_id = $ad_id;
        $fav->user_id = Auth::user()->id;
        $fav->save();
    }

    public function del_favorite($ad_id){
        $this->remove_trash();
        Favorite::where('ad_id', $ad_id)->where('user_id', Auth::user()->id)->delete();
    }

    //Remove fav note
    public function remove_fav_note(Request $request)
    {
        if ($request->id) {
            $fav = Favorite::find($request->id);
            if ($fav) {
                $fav->note = null;
                $fav->update();
            }
        }
        return array('success');
        exit();
    }

    //Store fav note
    public function store_fav_note(Request $request){
        if($request->id){
            $fav = Favorite::find($request->id);
            if($fav && $request->note){
                DB::beginTransaction();
                try{
                    $fav->note = $request->note;
                    $fav->update();
                    DB::commit();
                    $data = array('note'=>$fav->note);

                    return $data;
                }catch (\Exception $e){
                    DB::rollback();
                    (header("HTTP/1.0 404 Not Found"));
                    $data['failure'] = $e->getMessage();
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = ['Posten ble ikke funnet'];
            echo json_encode($data);
            exit();
        }
    }
}
