<?php

namespace App\Http\Controllers\Admin\ads;

use App\BannerClick;
use  App\Helpers\common;
use App\Admin\ads\Banner;
use Illuminate\Http\Request;
use App\Admin\ads\BannerView;
use App\Admin\Banners\BannerGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use niklasravnsborg\LaravelPdf\Pdf;

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
          $view = new BannerView();
          $views = $banner->views()->save($view);
        //   $views = $views+1;
        //   $banner->update(['views'=>$views]);
          return response()->json(['success'=>1]);
    }

    public function reports(Request $request,$id) {
        if($request->start_date && $request->end_date){
            $banner_clicks = DB::table('banner_clicks')->selectRaw("COUNT(id) as count_view, date(created_at) as date ")
                ->where('banner_id', $id)
                ->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date)
                ->groupBy('date')
                ->get();

            $banner_views = DB::table('banner_views')->selectRaw("COUNT(id) as count_view, date(created_at) as date ")
                ->where('banner_id', $id)
                ->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date)
                ->groupBy('date')
                ->get();

        }else{
            $compare_date = (date("Y-m-d", strtotime("-1 day")));
            if($request->date){
                $compare_date = $request->date;
            }
            $banner_clicks = DB::table('banner_clicks')->selectRaw("COUNT(id) as count_view, date(created_at) as date ")
                ->where('banner_id', $id)
                ->whereDate('created_at', '>', $compare_date)
                ->groupBy('date')
                ->get();

            $banner_views = DB::table('banner_views')->selectRaw("COUNT(id) as count_view, date(created_at) as date ")
                ->where('banner_id', $id)
                ->whereDate('created_at', '>', $compare_date)
                ->groupBy('date')
                ->get();
        }

        if($request->generate_pdf && $request->generate_pdf == 'true'){
            $html = view('admin.ads-managemnet.pdf_report',compact('banner_views','banner_clicks'))->render();
            $pdf = new Pdf($html);
            return $pdf->stream('NorgesHandel-CV.pdf');
        }

        $click_date = array();
        $click_count = array();
      
       // $total_views = $banner_views->count();
        $total_views = 0;
        $total_clicks = $banner_clicks->count();

        foreach ($banner_clicks as $click) {
            $click_date[] = $click->date;
            $click_count[] = $click->count_view;
        }
        $view_date = array();
        $view_count = array();
        foreach ($banner_views as $view) {
            $view_date[] = $view->date;
            $view_count[] = $view->count_view;
            $total_views = $total_views + $view->count_view;
        }
      
        return view('admin.ads-managemnet.reports',compact('click_date','click_count','view_date','view_count','total_clicks','total_views'));
    }

}
