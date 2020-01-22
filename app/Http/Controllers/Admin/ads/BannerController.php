<?php

namespace App\Http\Controllers\Admin\ads;

use App\Admin\ads\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'image' => '',
            'is_active' => $request->is_active,
            'category_id' => $request->cat_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ];
        $file = $request->banner_image;
        $data['image'] = $file->getClientOriginalName();
         
     
        
          $file->move('public/uploads/banners', $data['image']);
    
        Banner::create($data);
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
            'category_id' => $request->cat_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ];
        $file = $request->banner_image;
        if(isset($request->banner_image)){
            $data['image'] = $file->getClientOriginalName();
            $file->move('public/uploads/banners', $data['image']);
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
        unlink('public/uploads/banners/'.$banner->image);

        $banner->delete();
        return redirect()->back()->with('danger','Ad Deleted Successfully');

    }
}
