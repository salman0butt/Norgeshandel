<?php

namespace App\Http\Controllers\Admin\ads;

use App\Admin\ads\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use  App\Helpers\common;

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
        return view('admin.ads-managemnet.create');

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
            'banner_group' => $request->banner_group,
            'display_time_type' => $request->display_time_type,
            'display_time_duration' => $request->display_time_duration,
        ];

        if (!empty($request->banner_image)) {
           $file = $request->banner_image;
            common::update_media($file, $banner->id, Banner::class, 'banner');

        }
    

        $banner = new Banner($data);
        $banner->save();

      

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
        return view('admin.ads-managemnet.edit', compact('banner'));

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
            'banner_group' => $request->banner_group,
            'display_time_type' => $request->display_time_type,
            'display_time_duration' => $request->display_time_duration
        ];
        $file = $request->banner_image;
        if(isset($request->banner_image)){
           common::update_media($file, $id, Banner::class, 'banner');

            // $data['image'] = $file->getClientOriginalName();
            // $file->move('public/uploads/banners', $data['image']);
        }

        Banner::where('id', $id)->update($data);
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
}
