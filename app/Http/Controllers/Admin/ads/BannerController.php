<?php

namespace App\Http\Controllers\Admin\ads;

use  App\Helpers\common;
use App\Admin\ads\Banner;
use Illuminate\Http\Request;
use App\Admin\Banners\BannerGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::all();

        return view('admin.ads-managemnet.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $banner_groups = BannerGroup::all();
        return view('admin.ads-managemnet.create', compact('banner_groups'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->url,
            'is_active' => $request->is_active,
            'display_time_type' => $request->display_time_type,
            'display_time_duration' => $request->display_time_duration,
            'full_banner' => $request->full_banner
        ];
        
        $banner = new Banner($data);
        $banner->save();
        $banner->groups()->detach();
        $banner->groups()->attach($request->banner_group);

        if (!empty($request->banner_image)) {
           $file = $request->banner_image;
            common::update_media($file, $banner->id, Banner::class, 'banner',true,true,true);
        }


        // dd(App\Helpers\common::getMediaPath($banner->media))

        return redirect()->back() ->with('success','Banner Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::findOrFail($id);
        $groups = BannerGroup::all();
        return view('admin.ads-managemnet.edit', compact('banner', 'groups'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $data = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->url,
            'is_active' => $request->is_active,
            'display_time_type' => $request->display_time_type,
            'display_time_duration' => $request->display_time_duration,
            'full_banner' => $request->full_banner
        ];





        $file = $request->banner_image;
        if(isset($request->banner_image)){
           common::update_media($file, $id, Banner::class, 'banner');

            // $data['image'] = $file->getClientOriginalName();
            // $file->move('public/uploads/banners', $data['image']);
        }

        $banner = Banner::find($id);
        $banner->update($data);
        $banner->groups()->detach();
        $banner->groups()->attach($request->banner_group);

        //Banner::where('id', $id)->update($data);
        return redirect()->back()->with('success','Banner Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = Banner::findOrFail($id);
        common::delete_media($banner->id, Banner::class, 'banner');

        $banner->delete();
        return redirect()->back()->with('danger','Ad Deleted Successfully');

    }
    public function views($banner_id) {
          $banner = Banner::findOrFail($banner_id);
          $views = $banner->views;
          $views = $views+1;
          $banner->update(['views'=>$views]);
          return response()->json(['success'=>1]);
    }

}
