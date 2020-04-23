<?php

namespace App\Http\Controllers\Admin\ads;

use App\Admin\ads\Banner;
use Illuminate\Http\Request;
use App\Admin\Banners\BannerGroup;
use App\Http\Controllers\Controller;
use App\Admin\Banners\BannerGroupCategory;
use App\Admin\Banners\BannerGroup_position;


class BannerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banner_groups = BannerGroup::all();
        return view('admin.banner-group.index',compact('banner_groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $banners = Banner::all();
        return view('admin.banner-group.create',compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = [
            'title' => $request->title,
            'page_url' => $request->page_url,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end   
        ];

    $bannerGroup = new BannerGroup($data);

    
    $bannerGroup->save();
    //dd($request->location);
    
    foreach($request->location as $location){
        $Banner_pos = new BannerGroup_position();
        $Banner_pos->position = $location;
        $bannerGroup->positions()->save($Banner_pos);
    }
    foreach ($request->post_category as $category) {
    $Banner_pos = new BannerGroupCategory();
    $Banner_pos->post_category = $category;

    $bannerGroup->categories()->save($Banner_pos);
    }

    $bannerGroup->banners()->detach();
    $bannerGroup->banners()->attach($request->banners);


     
     
    return back()->with('success', 'Banner Created Successfully');
 

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
        $banners = Banner::all();
        $banner_group = BannerGroup::findOrFail($id);
       // dd($banners);
        return view('admin.banner-group.edit', compact('banners','banner_group'));

      
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
            'page_url' => $request->page_url,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end   
        ];
//   dd($data);
    $bannerGroup = BannerGroup::find($id);
    $bannerGroup->update($data);
    $bannerGroup->positions()->delete();
    $bannerGroup->categories()->delete();


    foreach ($request->location as $location) {
        $Banner_pos = new BannerGroup_position();
        $Banner_pos->position = $location;
     
        $bannerGroup->positions()->save($Banner_pos);
    }
     
    foreach ($request->post_category as $category) {
    $Banner_pos = new BannerGroupCategory();
    $Banner_pos->post_category = $category;

    $bannerGroup->categories()->save($Banner_pos);
    }

    $bannerGroup->banners()->detach();
    $bannerGroup->banners()->attach($request->banners);
     
        // $status = BannerGroup::where('id',$id)->update($data);
        // $
        // if ($status) {
            return back()->with('success', 'Banner Updated Successfully');
        // }
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
        $banner_group = BannerGroup::findOrFail($id)->delete();
        if ($banner_group) {
            return redirect()->back()->with('danger','Banner Group Deleted Successfully');
        }
    }
}
